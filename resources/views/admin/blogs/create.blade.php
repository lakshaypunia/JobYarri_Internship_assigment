@extends('layouts.admin')

@section('title', 'Add Blog')
@section('page-title', 'Add New Blog')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Blog title" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Published Date</label>
                    <input type="date" name="published_at" value="{{ old('published_at') }}"
                           class="form-control @error('published_at') is-invalid @enderror">
                    @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Short Description <span class="text-danger">*</span></label>
                    <textarea name="short_description" rows="2"
                              class="form-control @error('short_description') is-invalid @enderror"
                              placeholder="Brief summary shown on listing page" required>{{ old('short_description') }}</textarea>
                    @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                    <textarea name="content" rows="10"
                              class="form-control @error('content') is-invalid @enderror"
                              placeholder="Full blog content..." required>{{ old('content') }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Featured Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="form-control @error('image') is-invalid @enderror"
                           id="imageInput" onchange="previewImage(this)">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <img id="imagePreview" src="#" alt="Preview"
                         class="mt-2 rounded d-none" style="max-height:160px">
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Publish Blog</button>
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
