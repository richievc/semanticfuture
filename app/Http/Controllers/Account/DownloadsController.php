<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $downloads = $user->ebookAccess()->with('ebook')->paginate(10);

        return view('account.downloads', compact('downloads'));
    }
}
