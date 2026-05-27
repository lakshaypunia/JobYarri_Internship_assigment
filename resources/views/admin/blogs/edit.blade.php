@extends('layouts.admin')

@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                           class="form-control @error('title') is-invalid @enderror" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Published Date</label>
                    <input type="date" name="published_at"
                           value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}"
                           class="form-control @error('published_at') is-invalid @enderror">
                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Short Description <span class="text-danger">*</span></label>
                    <textarea name="short_description" rows="2"
                              class="form-control @error('short_description') is-invalid @enderror"
                              required>{{ old('short_description', $blog->short_description) }}</textarea>
                    @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                    <textarea name="content" rows="10"
                              class="form-control @error('content') is-invalid @enderror"
                              required>{{ old('content', $blog->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Featured Image</label>
                    @if($blog->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$blog->image) }}"
                                 class="rounded" style="max-height:120px">
                            <small class="text-muted d-block mt-1">Upload a new image to replace the current one.</small>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="form-control @error('image') is-invalid @enderror"
                           onchange="previewImage(this)">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <img id="imagePreview" src="#" alt="Preview"
                         class="mt-2 rounded d-none" style="max-height:160px">
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Update Blog</button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
    }
}
</script>
@endpush
