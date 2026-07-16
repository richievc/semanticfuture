<x-admin-layout title="Create Blog Post" active="blog">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.blog._form', ['post' => null])
                <button type="submit" class="btn btn-primary">Create blog post</button>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</x-admin-layout>
