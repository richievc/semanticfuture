<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EbooksController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->paginate(10);

        return view('admin.ebooks.index', compact('ebooks'));
    }

    public function create()
    {
        return view('admin.ebooks.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $this->handleUploads($request, $data);

        Ebook::create($data);

        return redirect()->route('admin.ebooks.index')->with('success', 'E-book created.');
    }

    public function show(Ebook $ebook)
    {
        $orderItems = OrderItem::with(['order.user:id,name,email', 'access'])
            ->where('ebook_id', $ebook->id)
            ->whereHas('order', fn ($q) => $q->where('status', 'paid'))
            ->latest()
            ->get();

        $totalPurchases = $orderItems->count();
        $totalRevenue = $orderItems->sum('line_total');
        $totalDownloads = $orderItems->sum(fn ($item) => $item->access?->download_count ?? 0);

        return view('admin.ebooks.show', compact('ebook', 'orderItems', 'totalPurchases', 'totalRevenue', 'totalDownloads'));
    }

    public function edit(Ebook $ebook)
    {
        return view('admin.ebooks.edit', compact('ebook'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $data = $this->validated($request, $ebook->id);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $this->handleUploads($request, $data, $ebook);

        $ebook->update($data);

        return redirect()->route('admin.ebooks.index')->with('success', 'E-book updated.');
    }

    public function destroy(Ebook $ebook)
    {
        if (OrderItem::where('ebook_id', $ebook->id)->exists()) {
            return redirect()->route('admin.ebooks.index')
                ->with('error', 'This e-book has orders attached, so it can\'t be deleted. Unpublish it instead.');
        }

        if ($ebook->cover_image) {
            Storage::disk('public')->delete($ebook->cover_image);
        }

        if ($ebook->file_path) {
            Storage::disk('local')->delete($ebook->file_path);
        }

        $ebook->delete();

        return redirect()->route('admin.ebooks.index')->with('success', 'E-book deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    protected function validated(Request $request, ?int $ignoreId = null): array
    {
        $slugRule = 'unique:ebooks,slug';
        if ($ignoreId) {
            $slugRule .= ','.$ignoreId;
        }

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', 'string', 'size:3'],
            'is_published' => ['boolean'],
            'max_downloads' => ['nullable', 'integer', 'min:1'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'ebook_file' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
        ]);
    }

    /**
     * Stores any uploaded cover image / PDF and writes the resulting paths
     * into $data. Cover images go on the public disk (they're displayed on
     * the storefront); the PDF itself goes on the private "local" disk so it
     * can only be served through a purchase-gated download route later, not
     * guessed/linked directly.
     */
    protected function handleUploads(Request $request, array &$data, ?Ebook $ebook = null): void
    {
        if ($request->hasFile('cover_image')) {
            if ($ebook?->cover_image) {
                Storage::disk('public')->delete($ebook->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        if ($request->hasFile('ebook_file')) {
            if ($ebook?->file_path) {
                Storage::disk('local')->delete($ebook->file_path);
            }
            $data['file_path'] = $request->file('ebook_file')->store('ebooks', 'local');
        }

        unset($data['ebook_file']);
    }
}
