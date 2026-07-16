<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    public function test_terms_page_is_publicly_available(): void
    {
        $this->get(route('terms'))
            ->assertOk()
            ->assertSee('Terms &amp; Conditions', false)
            ->assertSee('Web3 Connected')
            ->assertSee(route('privacy'));
    }

    public function test_privacy_page_is_publicly_available(): void
    {
        $this->get(route('privacy'))
            ->assertOk()
            ->assertSee('Privacy Policy')
            ->assertSee('PayPal')
            ->assertSee('IP address');
    }

    public function test_footer_links_to_both_legal_pages(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee(route('terms'))
            ->assertSee(route('privacy'));
    }
}
