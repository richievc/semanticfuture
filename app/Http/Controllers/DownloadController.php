<?php

namespace App\Http\Controllers;

use App\Models\CustomerEbookAccess;
use App\Models\ProductEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DownloadController extends Controller
{
    /**
     * Auth-protected entry point used by in-app buttons (My Downloads, the
     * post-purchase download page). Verifies the logged-in user actually
     * owns this access grant, then bounces them to a freshly-minted,
     * short-lived signed URL that does the actual file streaming. Buttons
     * in the app should always point here rather than embedding a signed
     * URL directly in the page, so the signed link is never sitting around
     * in rendered HTML longer than the redirect itself.
     */
    public function go(Request $request, CustomerEbookAccess $access)
    {
        abort_unless($access->user_id === $request->user()->id, 403);

        $this->assertUsable($access);

        $signedUrl = URL::temporarySignedRoute(
            'downloads.stream',
            now()->addMinutes(15),
            ['access' => $access->id]
        );

        ProductEvent::log(ProductEvent::DOWNLOAD_LINK_GENERATED, [
            'ebook_id' => $access->ebook_id,
            'user_id' => $access->user_id,
            'customer_ebook_access_id' => $access->id,
        ]);

        return redirect()->away($signedUrl);
    }

    /**
     * The actual file delivery. Protected by Laravel's `signed` middleware
     * (see routes/web.php) so the URL itself can't be tampered with or
     * reused past its expiry — but the signature being valid is treated as
     * "this link hasn't been forged or altered," not as "this purchase is
     * still good." Every access-control check below still runs regardless
     * of signature validity, so a revoked/refunded purchase loses access
     * immediately even against an old, still-time-valid emailed link.
     */
    public function stream(Request $request, CustomerEbookAccess $access)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'This download link is invalid or has expired.');
        }

        $this->assertUsable($access);

        $ebook = $access->ebook;

        if (! $ebook->file_path || ! Storage::disk('local')->exists($ebook->file_path)) {
            abort(404, 'The file for this e-book has not been uploaded yet.');
        }

        $wasRepeat = $access->download_count > 0;

        $access->increment('download_count');
        $access->forceFill(['last_downloaded_at' => now()])->save();

        ProductEvent::log(
            $wasRepeat ? ProductEvent::DOWNLOAD_REPEATED : ProductEvent::DOWNLOAD_COMPLETED,
            [
                'ebook_id' => $access->ebook_id,
                'user_id' => $access->user_id,
                'customer_ebook_access_id' => $access->id,
            ]
        );

        $downloadName = \Illuminate\Support\Str::slug($ebook->title).'.pdf';

        return Storage::disk('local')->download($ebook->file_path, $downloadName);
    }

    /**
     * Shared rules for whether a purchase still grants a download, checked
     * on both the redirect step and the actual stream step.
     */
    protected function assertUsable(CustomerEbookAccess $access): void
    {
        if ($access->revoked_at) {
            abort(403, 'Access to this download has been revoked for this order.');
        }

        if ($access->download_count >= $access->download_limit) {
            abort(403, 'You have used all of your downloads for this purchase. Contact us if you need another.');
        }

        $order = $access->orderItem?->order;

        if ($order && ! in_array($order->status, ['paid'], true)) {
            abort(403, 'This order is not eligible for download.');
        }
    }
}
