<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_published_posts_are_visible_on_the_public_blog(): void
    {
        $published = BlogPost::create([
            'title' => 'Published Article',
            'slug' => 'published-article',
            'body' => 'Public article body.',
            'is_published' => true,
            'published_at' => now()->subMinute(),
        ]);
        $draft = BlogPost::create([
            'title' => 'Draft Article',
            'slug' => 'draft-article',
            'body' => 'Draft article body.',
            'is_published' => false,
        ]);
        $scheduled = BlogPost::create([
            'title' => 'Scheduled Article',
            'slug' => 'scheduled-article',
            'body' => 'Scheduled article body.',
            'is_published' => true,
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('blog.index'))
            ->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($draft->title)
            ->assertDontSee($scheduled->title);

        $this->get(route('blog.show', $published))->assertOk()->assertSee('Public article body.');
        $this->get(route('blog.show', $draft))->assertNotFound();
        $this->get(route('blog.show', $scheduled))->assertNotFound();
    }

    public function test_admin_can_create_and_publish_a_blog_post(): void
    {
        $admin = Admin::create([
            'name' => 'Blog Editor',
            'email' => 'editor@example.com',
            'password' => 'a-secure-password',
        ]);

        $response = $this->actingAs($admin, 'admin')->post(route('admin.blog.store'), [
            'title' => 'A Useful New Article',
            'excerpt' => 'A concise summary.',
            'body' => "First paragraph.\n\nSecond paragraph.",
            'meta_description' => 'A useful article for semantic discovery creators.',
            'is_published' => '1',
        ]);

        $post = BlogPost::firstOrFail();

        $response->assertRedirect(route('admin.blog.edit', $post));
        $this->assertSame('a-useful-new-article', $post->slug);
        $this->assertSame($admin->id, $post->admin_id);
        $this->assertTrue($post->is_published);
        $this->assertNotNull($post->published_at);
        $this->get(route('blog.show', $post))->assertOk();
    }

    public function test_guest_cannot_manage_blog_posts(): void
    {
        $this->get(route('admin.blog.index'))->assertRedirect(route('admin.login'));
        $this->get(route('admin.blog.create'))->assertRedirect(route('admin.login'));
    }

    public function test_blog_body_renders_safe_markdown(): void
    {
        $post = BlogPost::create([
            'title' => 'Structured Article',
            'slug' => 'structured-article',
            'body' => "## Clear heading\n\n- First point\n\n<script>alert('no')</script>",
            'is_published' => true,
            'published_at' => now()->subMinute(),
        ]);

        $this->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee('<h2>Clear heading</h2>', false)
            ->assertSee('<li>First point</li>', false)
            ->assertDontSee('<script>', false);
    }
}
