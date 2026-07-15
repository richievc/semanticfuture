<x-admin-layout title="Digital Products" active="ebooks">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.ebooks.create') }}" class="btn btn-primary mb-3">Create Digital Product</a>
            <table class="table table-bordered">
                <thead><tr><th>Title</th><th>Price</th><th>Status</th><th>File</th><th style="width:260px;">Actions</th></tr></thead>
                <tbody>
                @forelse ($ebooks as $ebook)
                    <tr>
                        <td>{{ $ebook->title }}</td>
                        <td>{{ $ebook->currency }} {{ number_format($ebook->price, 2) }}</td>
                        <td>
                            <span class="badge {{ $ebook->is_published ? 'badge-success' : 'badge-secondary' }}">
                                {{ $ebook->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td>
                            @if ($ebook->file_path)
                                <span class="badge badge-info">Uploaded</span>
                            @else
                                <span class="badge badge-warning">Missing</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.ebooks.show', $ebook) }}" class="btn btn-sm btn-default">View</a>
                            <a href="{{ route('admin.ebooks.edit', $ebook) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.ebooks.destroy', $ebook) }}" method="post" class="d-inline" onsubmit="return confirm('Delete this e-book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-muted">No digital products yet.</td></tr>
                @endforelse
                </tbody>
            </table>
            {{ $ebooks->links() }}
        </div>
    </div>
</x-admin-layout>
