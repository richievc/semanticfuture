<?php

return [
    // The Ebook record (see database/seeders/DatabaseSeeder.php) that the
    // single-product pages (Pricing, Checkout) are built around. Once the
    // store carries more than one title, these pages should take an
    // {ebook} route parameter instead of reading this fixed slug.
    'ebook_slug' => env('EBOOK_SLUG', 'from-seo-to-semantic-discovery'),

    // The PayPal account that receives payment. Replace with your real business email.
    'paypal_business_email' => env('PAYPAL_BUSINESS_EMAIL', 'your-paypal-email@example.com'),

    // 'sandbox' while testing, 'live' once you're taking real payments.
    // Controls both the button's post-to URL and the IPN verification URL.
    'paypal_mode' => env('PAYPAL_MODE', 'sandbox'),

    'paypal_urls' => [
        'sandbox' => [
            'checkout' => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
            'ipn_verify' => 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr',
        ],
        'live' => [
            'checkout' => 'https://www.paypal.com/cgi-bin/webscr',
            'ipn_verify' => 'https://ipnpb.paypal.com/cgi-bin/webscr',
        ],
    ],

    'product_name' => env('EBOOK_PRODUCT_NAME', 'From SEO to Semantic Discovery (eBook, PDF)'),

    'price' => env('EBOOK_PRICE', '19.00'),

    'currency' => env('EBOOK_CURRENCY', 'USD'),

    // Where PayPal sends the buyer after a successful payment. This is a
    // UX redirect only — it is never trusted to grant access. Access is
    // only ever granted by the IPN webhook below, once PayPal itself
    // confirms the payment server-to-server.
    'return_url' => env('EBOOK_RETURN_URL', '/purchase-complete'),

    // Where the buyer lands if they cancel out of PayPal.
    'cancel_url' => env('EBOOK_CANCEL_URL', '/pricing'),

    // Where PayPal posts the asynchronous Instant Payment Notification.
    // Must be a publicly reachable HTTPS URL in production — PayPal's
    // servers need to be able to reach it directly, so this will not work
    // against a machine behind NAT/localhost without a tunnel (e.g. ngrok)
    // during testing.
    'ipn_url' => env('EBOOK_IPN_URL', '/webhooks/paypal'),
];
