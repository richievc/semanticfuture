<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use App\Models\ProductEvent;
use Illuminate\Http\Request;

class EbookStoreController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::published()->latest()->get();

        return view('ebooks.index', compact('ebooks'));
    }

    public function show(Request $request, Ebook $ebook)
    {
        abort_unless($ebook->is_published, 404);

        ProductEvent::log(ProductEvent::VIEWED, [
            'ebook_id' => $ebook->id,
            'user_id' => $request->user()?->id,
        ]);

        return view('ebooks.show', compact('ebook'));
    }
}
