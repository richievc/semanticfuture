<x-layout title="Login">
    <section class="flex items-center justify-center min-h-screen px-6 py-12">
        <div class="w-full max-w-md">
            <div class="glass glow-border rounded-3xl p-8">
                <h1 class="text-2xl font-bold text-white mb-2">Welcome Back</h1>
                <p class="text-slate-400 mb-8">Sign in to your account to manage orders and downloads.</p>

                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="your@email.com" value="{{ old('email') }}" required>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="••••••••" required>
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-white/10 bg-white/5">
                            <span class="ml-2 text-sm text-slate-400">Remember me</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-accent-400 to-accent-600 text-navy-950 rounded-lg font-semibold hover:shadow-lg transition-all">
                        Sign In
                    </button>
                </form>

                <p class="text-center text-slate-400 mt-6">
                    Don't have an account? <a href="{{ route('register') }}" class="text-accent-300 hover:text-accent-200 font-medium">Sign up</a>
                </p>
            </div>
        </div>
    </section>
</x-layout>
