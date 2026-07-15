<x-admin-layout title="Edit Digital Product" active="ebooks">
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
            <form action="{{ route('admin.ebooks.update', $ebook) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group"><label>Title</label><input type="text" name="title" value="{{ old('title', $ebook->title) }}" class="form-control" required></div>
                <div class="form-group"><label>Slug</label><input type="text" name="slug" value="{{ old('slug', $ebook->slug) }}" class="form-control"></div>
                <div class="form-group"><label>Short description</label><textarea name="short_description" class="form-control">{{ old('short_description', $ebook->short_description) }}</textarea></div>
                <div class="form-group"><label>Description</label><textarea name="description" class="form-control" rows="6">{{ old('description', $ebook->description) }}</textarea></div>
                <div class="form-group"><label>Price</label><input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $ebook->price) }}"></div>
                <div class="form-group"><label>Currency</label><input type="text" name="currency" class="form-control" value="{{ old('currency', $ebook->currency) }}" maxlength="3"></div>
                <div class="form-group"><label>Max downloads per purchase</label><input type="number" name="max_downloads" class="form-control" value="{{ old('max_downloads', $ebook->max_downloads) }}"></div>

                <div class="form-group">
                    <label>Cover image</label>
                    @if ($ebook->cover_image)
                        <div class="mb-2"><img src="{{ asset('storage/'.$ebook->cover_image) }}" alt="Current cover" style="max-height:120px;"></div>
                    @endif
                    <input type="file" name="cover_image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Leave blank to keep the current cover.</small>
                </div>

                <div class="form-group">
                    <label>E-book file (PDF)</label>
                    @if ($ebook->file_path)
                        <p class="mb-1"><i class="fas fa-file-pdf"></i> A file is already uploaded (stored privately).</p>
                    @else
                        <p class="mb-1 text-muted">No file uploaded yet — buyers will see "not available" on their download page until one is added.</p>
                    @endif
                    <input type="file" name="ebook_file" class="form-control" accept="application/pdf">
                    <small class="form-text text-muted">Upload a new PDF to replace the current file. Leave blank to keep it.</small>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_published" class="form-check-input" value="1" @checked(old('is_published', $ebook->is_published))>
                    <label class="form-check-label">Published</label>
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('admin.ebooks.show', $ebook) }}" class="btn btn-default">Cancel</a>
            </form>
        </div>
    </div>
</x-admin-layout>
