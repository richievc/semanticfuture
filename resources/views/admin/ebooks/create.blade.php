<x-admin-layout title="Create Digital Product" active="ebooks">
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.ebooks.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group"><label>Title</label><input type="text" name="title" value="{{ old('title') }}" class="form-control" required></div>
                <div class="form-group"><label>Slug</label><input type="text" name="slug" value="{{ old('slug') }}" class="form-control" placeholder="Leave blank to auto-generate from title"></div>
                <div class="form-group"><label>Short description</label><textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea></div>
                <div class="form-group"><label>Price</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', '19.00') }}"></div>
                <div class="form-group"><label>Currency</label><input type="text" name="currency" class="form-control" value="{{ old('currency', 'USD') }}" maxlength="3"></div>
                <div class="form-group"><label>Max downloads per purchase</label><input type="number" name="max_downloads" class="form-control" value="{{ old('max_downloads', 3) }}"></div>

                <div class="form-group">
                    <label>Cover image</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                </div>

                <div class="form-group">
                    <label>E-book file (PDF)</label>
                    <input type="file" name="ebook_file" class="form-control" accept="application/pdf">
                    <small class="form-text text-muted">Stored privately — never publicly linkable. Buyers can only reach it through a purchase-gated, signed download link.</small>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_published" class="form-check-input" value="1" @checked(old('is_published', true))>
                    <label class="form-check-label">Published</label>
                </div>
                <button type="submit" class="btn btn-primary">Create digital product</button>
                <a href="{{ route('admin.ebooks.index') }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</x-admin-layout>
