<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Ebook;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // NOTE: change this password (and the admin email) before this app
        // ever leaves your local machine — it's a well-known default.
        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        Ebook::updateOrCreate(
            ['slug' => config('shop.ebook_slug')],
            [
                'title' => 'From SEO to Semantic Discovery',
                'short_description' => 'The Changing Horizon — a creator\'s handbook and workbook on Gemini, AI Overviews, and Semantic IDs.',
                'description' => "A creator's handbook on Google's evolving AI ecosystem — Gemini, AI Overviews, and Semantic Discovery — written for YouTube creators who want to prepare thoughtfully, not react to hype. Fourteen chapters, each following the same Overview / Why It Matters / Practical Guidance / Key Takeaways / Creator Checklist structure, plus a built-in workbook (Knowledge Check, Creator Worksheet, Action Items, and Reflection Journal in every chapter), a Quick Reference Guide, a 30-Day Semantic Discovery Workbook, a Semantic Readiness Scorecard, a glossary, and a master creator checklist.",
                'cover_image' => null,
                'price' => config('shop.price'),
                'currency' => config('shop.currency'),
                'file_path' => null,
                'is_published' => true,
                'max_downloads' => 3,
            ]
        );
    }
}
