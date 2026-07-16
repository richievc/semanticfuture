<x-admin-layout title="Edit Blog Post" active="blog">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.update', $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.blog._form', ['post' => $post])
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-default">Back to posts</a>
            </form>
        </div>
    </div>
</x-admin-layout>
