<?php

namespace Tests\Feature;

use App\Models\Ebook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EbookStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_ebooks_are_visible_on_the_storefront(): void
    {
        Ebook::factory()->create([
            'slug' => 'published-guide',
            'is_published' => true,
        ]);

        $response = $this->get('/ebooks');

        $response->assertOk();
        $response->assertSee('published-guide');
    }

    public function test_unpublished_ebooks_are_hidden_from_the_storefront(): void
    {
        Ebook::factory()->create([
            'slug' => 'draft-guide',
            'is_published' => false,
        ]);

        $response = $this->get('/ebooks');

        $response->assertOk();
        $response->assertDontSee('draft-guide');
    }
}
