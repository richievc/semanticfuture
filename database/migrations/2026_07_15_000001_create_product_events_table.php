<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Lightweight event log for storefront + admin analytics. Deliberately
     * does not store payment details (card numbers, PayPal payer info,
     * etc.) — order/payment records already live in orders/payment_events,
     * and those are the source of truth for anything money-related. This
     * table exists purely so the admin analytics dashboard can report on
     * behavior (views, checkout starts, downloads) without joining against
     * sensitive tables.
     */
    public function up(): void
    {
        Schema::create('product_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->foreignId('ebook_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('customer_ebook_access_id')->nullable()
                ->constrained('customer_ebook_access')->nullOnDelete();
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->json('meta')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->index(['event_type', 'created_at']);
            $table->index(['ebook_id', 'event_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_events');
    }
};
