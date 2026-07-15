<x-layout title="Register">
    <section class="flex items-center justify-center min-h-screen px-6 py-12">
        <div class="w-full max-w-md">
            <div class="glass glow-border rounded-3xl p-8">
                <h1 class="text-2xl font-bold text-white mb-2">Create Account</h1>
                <p class="text-slate-400 mb-8">Sign up to purchase and download e-books.</p>

                <form method="POST" action="{{ route('register.submit') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="John Doe" value="{{ old('name') }}" required>
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="your@email.com" value="{{ old('email') }}" required>
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="••••••••" required>
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-accent-500" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-accent-400 to-accent-600 text-navy-950 rounded-lg font-semibold hover:shadow-lg transition-all">
                        Create Account
                    </button>
                </form>

                <p class="text-center text-slate-400 mt-6">
                    Already have an account? <a href="{{ route('login') }}" class="text-accent-300 hover:text-accent-200 font-medium">Sign in</a>
                </p>
            </div>
        </div>
    </section>
</x-layout>
