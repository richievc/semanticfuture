<?php

namespace App\Mail;

use App\Models\CustomerEbookAccess;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class OrderConfirmed extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $downloadUrl;

    public function __construct(
        public Order $order,
        public CustomerEbookAccess $access,
    ) {
        // Long-lived enough that someone checking their inbox a few days
        // later still finds a working link, short-lived enough that a
        // leaked/forwarded email doesn't grant download access forever.
        // The stream route itself re-checks revocation/limits regardless
        // of signature validity, so this is defense in depth, not the only
        // access check.
        $this->downloadUrl = URL::temporarySignedRoute(
            'downloads.stream',
            now()->addDays(7),
            ['access' => $access->id]
        );
    }

    public function build(): self
    {
        return $this
            ->subject('Your order is confirmed — '.$this->order->items->first()?->product_title_snapshot)
            ->view('emails.order-confirmed');
    }
}
