<x-admin-layout title="Blog Posts" active="blog">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary mb-3">Create Blog Post</a>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead><tr><th>Title</th><th>Author</th><th>Status</th><th>Publish date</th><th style="width:220px;">Actions</th></tr></thead>
                    <tbody>
                    @forelse ($posts as $post)
                        @php
                            $isLive = $post->is_published && $post->published_at?->isPast();
                            $isScheduled = $post->is_published && $post->published_at?->isFuture();
                        @endphp
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->author?->name ?? 'Unknown' }}</td>
                            <td>
                                <span class="badge {{ $isLive ? 'badge-success' : ($isScheduled ? 'badge-info' : 'badge-secondary') }}">
                                    {{ $isLive ? 'Published' : ($isScheduled ? 'Scheduled' : 'Draft') }}
                                </span>
                            </td>
                            <td>{{ $post->published_at?->format('M j, Y g:i A') ?? '—' }}</td>
                            <td>
                                @if ($isLive)
                                    <a href="{{ route('blog.show', $post) }}" class="btn btn-sm btn-default" target="_blank">View</a>
                                @endif
                                <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-muted">No blog posts yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{ $posts->links() }}
        </div>
    </div>
</x-admin-layout>
