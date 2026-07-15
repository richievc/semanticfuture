<x-layout title="My Account">
    <section class="mx-auto max-w-4xl px-6 py-12 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">My Account</h1>

        <div class="grid gap-6 md:grid-cols-2 mb-8">
            <div class="glass glow-border rounded-lg p-6">
                <h2 class="text-lg font-semibold text-accent-300 mb-4">Profile Information</h2>
                <p class="text-slate-300 mb-2"><strong>Name:</strong> {{ $user->name }}</p>
                <p class="text-slate-300 mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                <p class="text-slate-300 mb-4"><strong>Member Since:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                <a href="#" class="text-accent-300 hover:text-accent-200">Edit Profile →</a>
            </div>

            <div class="glass glow-border rounded-lg p-6">
                <h2 class="text-lg font-semibold text-accent-300 mb-4">Account Actions</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('account.orders') }}" class="text-accent-300 hover:text-accent-200 flex items-center gap-2">View Orders <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a></li>
                    <li><a href="{{ route('account.downloads') }}" class="text-accent-300 hover:text-accent-200 flex items-center gap-2">My Downloads <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a></li>
                    <li><a href="#" class="text-accent-300 hover:text-accent-200 flex items-center gap-2">Change Password <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></a></li>
                </ul>
            </div>
        </div>

        <div class="glass glow-border rounded-lg p-6">
            <h2 class="text-lg font-semibold text-accent-300 mb-4">Recent Activity</h2>
            <p class="text-slate-400">No recent activity.</p>
        </div>
    </section>
</x-layout>
