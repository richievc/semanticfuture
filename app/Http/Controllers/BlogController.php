<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->with('author:id,name')
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        abort_unless(
            $post->is_published && $post->published_at?->isPast(),
            404,
        );

        $post->load('author:id,name');

        return view('blog.show', compact('post'));
    }
}
