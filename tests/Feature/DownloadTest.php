<?php

namespace Tests\Feature;

use App\Models\CustomerEbookAccess;
use App\Models\Ebook;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_paid_customer_can_download_the_pdf_attached_to_their_purchase(): void
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $filePath = 'ebooks/purchased-guide.pdf';
        Storage::disk('local')->put($filePath, '%PDF-1.4 test document');

        $ebook = Ebook::factory()->create([
            'title' => 'Purchased Guide',
            'file_path' => $filePath,
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'TEST-ORDER-1',
            'status' => 'paid',
            'subtotal' => 19.99,
            'total' => 19.99,
            'currency' => 'USD',
            'paid_at' => now(),
        ]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'ebook_id' => $ebook->id,
            'product_title_snapshot' => $ebook->title,
            'unit_price_snapshot' => 19.99,
            'quantity' => 1,
            'line_total' => 19.99,
        ]);

        $access = CustomerEbookAccess::create([
            'user_id' => $user->id,
            'ebook_id' => $ebook->id,
            'order_item_id' => $orderItem->id,
            'granted_at' => now(),
            'download_limit' => 3,
        ]);

        $redirect = $this->actingAs($user)->get(route('downloads.go', $access));

        $redirect->assertRedirect();

        $this->get($redirect->headers->get('Location'))
            ->assertOk()
            ->assertDownload('purchased-guide.pdf');

        $this->assertDatabaseHas('customer_ebook_access', [
            'id' => $access->id,
            'download_count' => 1,
        ]);
        $this->assertDatabaseHas('product_events', [
            'event_type' => ProductEvent::DOWNLOAD_COMPLETED,
            'ebook_id' => $ebook->id,
            'user_id' => $user->id,
            'customer_ebook_access_id' => $access->id,
        ]);
    }
}
