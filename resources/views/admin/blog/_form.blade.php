@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="title">Title</label>
    <input id="title" type="text" name="title" value="{{ old('title', $post?->title) }}" class="form-control" maxlength="255" required>
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input id="slug" type="text" name="slug" value="{{ old('slug', $post?->slug) }}" class="form-control" maxlength="255" placeholder="Leave blank to generate from the title">
</div>
<div class="form-group">
    <label for="excerpt">Excerpt</label>
    <textarea id="excerpt" name="excerpt" class="form-control" rows="3" maxlength="500">{{ old('excerpt', $post?->excerpt) }}</textarea>
    <small class="form-text text-muted">A short summary used on the blog index.</small>
</div>
<div class="form-group">
    <label for="body">Article body</label>
    <textarea id="body" name="body" class="form-control" rows="18" required>{{ old('body', $post?->body) }}</textarea>
    <small class="form-text text-muted">Plain text is rendered safely with line breaks preserved.</small>
</div>
<div class="form-group">
    <label for="meta_description">SEO description</label>
    <textarea id="meta_description" name="meta_description" class="form-control" rows="2" maxlength="160">{{ old('meta_description', $post?->meta_description) }}</textarea>
</div>
<div class="form-group">
    <label for="featured_image">Featured image</label>
    @if ($post?->imageUrl())
        <div class="mb-2"><img src="{{ $post->imageUrl() }}" alt="" style="max-height:160px; max-width:100%;"></div>
    @endif
    <input id="featured_image" type="file" name="featured_image" class="form-control" accept="image/*">
    <small class="form-text text-muted">Optional. Uploading a new image replaces the current one.</small>
</div>
<div class="form-group">
    <label for="published_at">Publish date and time</label>
    <input id="published_at" type="datetime-local" name="published_at" value="{{ old('published_at', $post?->published_at?->format('Y-m-d\TH:i')) }}" class="form-control">
    <small class="form-text text-muted">Leave blank to publish immediately, or choose a future time to schedule.</small>
</div>
<div class="form-check mb-3">
    <input id="is_published" type="checkbox" name="is_published" class="form-check-input" value="1" @checked(old('is_published', $post?->is_published ?? false))>
    <label for="is_published" class="form-check-label">Published</label>
</div>
