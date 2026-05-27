@extends('layouts.admin')
@section('title', 'Edit Blog')
@section('page-title', 'Edit Blog')

@push('styles')
<style>
.form-panel { background:#fff;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden; }
.form-panel-header { padding:1.1rem 1.4rem;border-bottom:1px solid #f1f5f9;font-size:.85rem;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:.5rem; }
.form-panel-body { padding:1.4rem; }
.field-label { font-size:.8rem;font-weight:600;color:#374151;margin-bottom:.4rem;display:block; }
.req { color:#ef4444; }
.field-input { width:100%;padding:.7rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.875rem;font-family:'Inter',sans-serif;color:#0f172a;background:#f8fafc;transition:border .2s,box-shadow .2s;outline:none; }
.field-input:focus { border-color:#6366f1;background:#fff;box-shadow:0 0 0 4px rgba(99,102,241,.08); }
.field-input.is-invalid { border-color:#ef4444; }
.field-error { font-size:.75rem;color:#ef4444;margin-top:.3rem; }
select.field-input { cursor:pointer; }
textarea.field-input { resize:vertical;line-height:1.6; }
.image-upload-area { border:2px dashed #e2e8f0;border-radius:12px;padding:1.5rem;text-align:center;cursor:pointer;transition:border .2s,background .2s;background:#f8fafc; }
.image-upload-area:hover { border-color:#6366f1;background:#eef2ff; }
.current-img { border-radius:10px;overflow:hidden;margin-bottom:1rem;position:relative; }
.current-img img { width:100%;height:140px;object-fit:cover; }
.current-img-label { position:absolute;bottom:8px;left:8px;background:rgba(0,0,0,.55);color:#fff;font-size:.7rem;font-weight:600;padding:.2rem .6rem;border-radius:6px;backdrop-filter:blur(4px); }
.btn-submit { display:inline-flex;align-items:center;gap:.5rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;padding:.7rem 1.6rem;font-size:.875rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:opacity .2s,transform .15s; }
.btn-submit:hover { opacity:.9;transform:translateY(-1px); }
.btn-cancel { display:inline-flex;align-items:center;gap:.4rem;background:#fff;color:#64748b;border:1.5px solid #e2e8f0;border-radius:10px;padding:.7rem 1.2rem;font-size:.875rem;font-weight:600;font-family:'Inter',sans-serif;cursor:pointer;text-decoration:none;transition:all .2s; }
.btn-cancel:hover { border-color:#94a3b8;color:#374151; }
</style>
@endpush

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('admin.blogs.index') }}" style="color:#94a3b8;text-decoration:none;font-size:.82rem">
        <i class="bi bi-arrow-left me-1"></i>Back to Blogs
    </a>
</div>

<form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="row g-3">

    <div class="col-lg-8">
        <div class="form-panel mb-3">
            <div class="form-panel-header">
                <i class="bi bi-type" style="color:#6366f1"></i> Blog Content
            </div>
            <div class="form-panel-body">
                <div class="mb-3">
                    <label class="field-label">Title <span class="req">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $blog->title) }}"
                           class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}" required>
                    @error('title')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="field-label">Short Description <span class="req">*</span></label>
                    <textarea name="short_description" rows="2"
                              class="field-input {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                              required>{{ old('short_description', $blog->short_description) }}</textarea>
                    @error('short_description')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Full Content <span class="req">*</span></label>
                    <textarea name="content" rows="12"
                              class="field-input {{ $errors->has('content') ? 'is-invalid' : '' }}"
                              required>{{ old('content', $blog->content) }}</textarea>
                    @error('content')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="form-panel">
            <div class="form-panel-header">
                <i class="bi bi-image" style="color:#f59e0b"></i> Featured Image
            </div>
            <div class="form-panel-body">
                @if($blog->image)
                <div class="current-img">
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="Current image">
                    <span class="current-img-label">Current image</span>
                </div>
                @endif
                <div class="image-upload-area" onclick="document.getElementById('imageInput').click()">
                    <i class="bi bi-arrow-repeat" style="font-size:1.5rem;color:#94a3b8"></i>
                    <div style="font-size:.82rem;color:#64748b;margin-top:.4rem">
                        Click to replace image
                    </div>
                    <img id="imagePreview" src="#" alt="Preview"
                         class="d-none rounded mt-2" style="max-height:140px;max-width:100%">
                </div>
                <input type="file" id="imageInput" name="image" accept="image/*" class="d-none"
                       onchange="handleImageUpload(this)">
                @error('image')<div class="field-error mt-2">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="form-panel mb-3">
            <div class="form-panel-header">
                <i class="bi bi-sliders" style="color:#10b981"></i> Settings
            </div>
            <div class="form-panel-body">
                <div class="mb-3">
                    <label class="field-label">Category <span class="req">*</span></label>
                    <select name="category_id"
                            class="field-input {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                        <option value="">Choose categoryâ€¦</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $blog->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Publish Date</label>
                    <input type="date" name="published_at"
                           value="{{ old('published_at', $blog->published_at?->format('Y-m-d')) }}"
                           class="field-input {{ $errors->has('published_at') ? 'is-invalid' : '' }}">
                    @error('published_at')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-2">
            <button type="submit" class="btn-submit w-100 justify-content-center">
                <i class="bi bi-check2"></i> Save Changes
            </button>
            <a href="{{ route('admin.blogs.index') }}" class="btn-cancel justify-content-center">
                Cancel
            </a>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
function handleImageUpload(input) {
    if (input.files && input.files[0]) {
        const p = document.getElementById('imagePreview');
        p.src = URL.createObjectURL(input.files[0]);
        p.classList.remove('d-none');
    }
}
</script>
@endpush

