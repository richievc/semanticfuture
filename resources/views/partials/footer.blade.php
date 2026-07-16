<footer class="mt-24 border-t border-white/5">
    <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8">
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-4">
            <div class="lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-semibold text-white">
                    <img src="{{ asset('images/brand/icon.png') }}" alt="" class="h-8 w-8" width="32" height="32">
                    <span>Semantic<span class="text-accent-400">Future</span></span>
                </a>
                <p class="mt-4 max-w-sm text-sm leading-relaxed text-slate-400">
                    A creator's handbook on Gemini, AI Overviews, and Semantic Discovery — helping YouTube creators
                    understand Google's evolving search ecosystem and prepare their workflow, calmly and practically.
                </p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white">Navigate</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-400">
                    <li><a href="{{ route('home') }}" class="hover:text-accent-300">Home</a></li>
                    <li><a href="{{ route('features') }}" class="hover:text-accent-300">Features</a></li>
                    <li><a href="{{ route('pricing') }}" class="hover:text-accent-300">Pricing</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-accent-300">Blog</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-accent-300">About</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-accent-300">Contact</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-white">Get the book</h3>
                <p class="mt-4 text-sm text-slate-400">One-time purchase, instant PDF download.</p>
                <div class="mt-4">
                    <x-button href="{{ route('pricing') }}" variant="secondary" size="sm">View pricing</x-button>
                </div>
            </div>
        </div>

        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/5 pt-8 sm:flex-row">
            <p class="text-xs text-slate-500">&copy; {{ date('Y') }} SemanticFuture. All rights reserved.</p>
            <p class="text-xs text-slate-500">Built for creators preparing for Google's evolving search ecosystem.</p>
        </div>
    </div>
</footer>
