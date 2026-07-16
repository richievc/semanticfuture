<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogPostsController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author:id,name')->latest()->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title']);
        $data['admin_id'] = auth('admin')->id();
        $this->preparePublication($request, $data);
        $this->handleImage($request, $data);

        $post = BlogPost::create($data);

        return redirect()->route('admin.blog.edit', $post)->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blog)
    {
        return view('admin.blog.edit', ['post' => $blog]);
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $this->validated($request, $blog);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? $data['title'], $blog);
        $this->preparePublication($request, $data);
        $this->handleImage($request, $data, $blog);

        $blog->update($data);

        return redirect()->route('admin.blog.edit', $blog)->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }

    /** @return array<string, mixed> */
    protected function validated(Request $request, ?BlogPost $post = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blog_posts')->ignore($post)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'max:4096'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'published_at' => ['nullable', 'date'],
        ]);
    }

    /** @param array<string, mixed> $data */
    protected function preparePublication(Request $request, array &$data): void
    {
        $data['is_published'] = $request->boolean('is_published');

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }
    }

    /** @param array<string, mixed> $data */
    protected function handleImage(Request $request, array &$data, ?BlogPost $post = null): void
    {
        if ($request->hasFile('featured_image')) {
            if ($post?->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }
    }

    protected function uniqueSlug(string $value, ?BlogPost $post = null): string
    {
        $base = Str::slug($value) ?: Str::random(8);
        $slug = $base;
        $suffix = 2;

        while (BlogPost::where('slug', $slug)
            ->when($post, fn ($query) => $query->whereKeyNot($post->getKey()))
            ->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}
