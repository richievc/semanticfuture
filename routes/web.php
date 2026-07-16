<?php

use App\Http\Controllers\Account\DashboardController as AccountDashboardController;
use App\Http\Controllers\Account\DownloadsController;
use App\Http\Controllers\Account\OrdersController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\BlogPostsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EbooksController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EbookStoreController;
use App\Http\Controllers\PayPalWebhookController;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/features', function () {
    return view('pages.features');
})->name('features');

Route::get('/pricing', function () {
    $ebook = Ebook::where('slug', config('shop.ebook_slug'))->published()->first();

    return view('pages.pricing', compact('ebook'));
})->name('pricing');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:180'],
        'message' => ['required', 'string', 'max:2000'],
    ]);

    Log::info('Contact form submission', $request->only('name', 'email', 'message'));

    return redirect()->route('contact')->with('success', 'Thanks — your message is in. We\'ll get back to you soon.');
})->name('contact.submit');

Route::get('/preview', function () {
    return view('pages.preview');
})->name('preview');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/admin', function () {
    return redirect()->route(auth('admin')->check() ? 'admin.dashboard' : 'admin.login');
})->name('admin.index');

/*
|--------------------------------------------------------------------------
| Purchase flow
|--------------------------------------------------------------------------
| Landing (home) -> Book Details (ebooks.show) -> Checkout -> PayPal ->
| Purchase Complete -> Download. Requires login (customer_ebook_access.
| user_id is NOT NULL), so this whole group sits behind the `auth`
| middleware — signed-out visitors hitting /checkout are bounced to /login
| and returned here after signing in.
|
| GET /checkout creates (or reuses) a *pending* Order and renders the real
| <x-paypal-button :order="$order" /> component, which posts the buyer
| straight to PayPal. Nothing here ever marks an order paid — that only
| ever happens in PayPalWebhookController, once PayPal's IPN confirms the
| payment server-to-server. /purchase-complete is just where PayPal
| redirects the buyer back to afterwards; it reflects whatever the order's
| status already is by the time they land on it.
*/

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::get('/purchase-complete', [CheckoutController::class, 'complete'])->name('purchase-complete');
    Route::get('/download', [CheckoutController::class, 'download'])->name('download');

    // Bounces the logged-in owner of an access grant to a freshly-minted,
    // short-lived signed download URL. In-app buttons should link here
    // rather than to downloads.stream directly.
    Route::get('/downloads/{access}/go', [DownloadController::class, 'go'])->name('downloads.go');
});

// The actual file delivery. Deliberately outside the `auth` group so a
// purchaser can also use the link straight from their confirmation email
// without needing an active session on that device — the signature (and
// the ownership/revocation/limit checks inside the controller) is what
// authorizes the request instead.
Route::get('/downloads/{access}/file', [DownloadController::class, 'stream'])
    ->middleware('signed')
    ->name('downloads.stream');

// PayPal's asynchronous IPN postback. No auth, no CSRF (see
// bootstrap/app.php) — authenticity is instead established by
// re-verifying the postback directly with PayPal inside
// PayPalWebhookController before anything in it is trusted.
Route::post('/webhooks/paypal', [PayPalWebhookController::class, 'handle'])->name('paypal.ipn');

// Kept as an alias so any existing links/bookmarks still resolve.
Route::redirect('/thank-you', '/download', 301);

Route::get('/ebooks', [EbookStoreController::class, 'index'])->name('ebooks.index');
Route::get('/ebooks/{ebook:slug}', [EbookStoreController::class, 'show'])->name('ebooks.show');

// Customer authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthLoginController::class, 'login'])->name('login.submit');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');
});

// Customer account routes
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/', AccountDashboardController::class)->name('dashboard');
    Route::get('/orders', OrdersController::class)->name('orders');
    Route::get('/downloads', DownloadsController::class)->name('downloads');
});

Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::get('/admin/analytics', AdminAnalyticsController::class)->name('admin.analytics');
    Route::resource('/admin/blog', BlogPostsController::class)
        ->except('show')
        ->parameters(['blog' => 'blog'])
        ->names('admin.blog');
    Route::resource('/admin/ebooks', EbooksController::class)->names('admin.ebooks');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
