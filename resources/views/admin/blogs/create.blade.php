@extends('layouts.admin')
@section('title', 'New Blog')
@section('page-title', 'Create New Blog')

@push('styles')
<style>
.form-panel {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0; overflow: hidden;
}
.form-panel-header {
    padding: 1.1rem 1.4rem; border-bottom: 1px solid #f1f5f9;
    font-size: .85rem; font-weight: 700; color: #0f172a;
    display: flex; align-items: center; gap: .5rem;
}
.form-panel-body { padding: 1.4rem; }
.field-label {
    font-size: .8rem; font-weight: 600; color: #374151;
    margin-bottom: .4rem; display: block;
}
.req { color: #ef4444; }
.field-input {
    width: 100%; padding: .7rem 1rem;
    border: 1.5px solid #e2e8f0; border-radius: 10px;
    font-size: .875rem; font-family: 'Inter', sans-serif;
    color: #0f172a; background: #f8fafc;
    transition: border .2s, box-shadow .2s; outline: none;
}
.field-input:focus { border-color: #6366f1; background: #fff; box-shadow: 0 0 0 4px rgba(99,102,241,.08); }
.field-input.is-invalid { border-color: #ef4444; }
.field-error { font-size: .75rem; color: #ef4444; margin-top: .3rem; }
select.field-input { cursor: pointer; }
textarea.field-input { resize: vertical; line-height: 1.6; }

.image-upload-area {
    border: 2px dashed #e2e8f0; border-radius: 12px;
    padding: 2rem; text-align: center; cursor: pointer;
    transition: border .2s, background .2s;
    background: #f8fafc;
}
.image-upload-area:hover { border-color: #6366f1; background: #eef2ff; }
.image-upload-area.has-file { border-style: solid; border-color: #6366f1; }
.upload-icon { font-size: 2rem; color: #94a3b8; margin-bottom: .5rem; }
.upload-text { font-size: .82rem; color: #64748b; }
.upload-hint { font-size: .72rem; color: #94a3b8; margin-top: .25rem; }

.btn-submit {
    display: inline-flex; align-items: center; gap: .5rem;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff; border: none; border-radius: 10px;
    padding: .7rem 1.6rem; font-size: .875rem; font-weight: 700;
    font-family: 'Inter', sans-serif; cursor: pointer;
    transition: opacity .2s, transform .15s;
}
.btn-submit:hover { opacity: .9; transform: translateY(-1px); }
.btn-cancel {
    display: inline-flex; align-items: center; gap: .4rem;
    background: #fff; color: #64748b; border: 1.5px solid #e2e8f0;
    border-radius: 10px; padding: .7rem 1.2rem;
    font-size: .875rem; font-weight: 600; font-family: 'Inter', sans-serif;
    cursor: pointer; text-decoration: none; transition: all .2s;
}
.btn-cancel:hover { border-color: #94a3b8; color: #374151; }
</style>
@endpush

@section('content')
<div class="d-flex align-items-center gap-2 mb-3">
    <a href="{{ route('admin.blogs.index') }}" style="color:#94a3b8;text-decoration:none;font-size:.82rem">
        <i class="bi bi-arrow-left me-1"></i>Back
    </a>
</div>

<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
@csrf
<div class="row g-3">

    {{-- Main content --}}
    <div class="col-lg-8">
        <div class="form-panel mb-3">
            <div class="form-panel-header">
                <i class="bi bi-type" style="color:#6366f1"></i> Blog Content
            </div>
            <div class="form-panel-body">
                <div class="mb-3">
                    <label class="field-label">Title <span class="req">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="field-input {{ $errors->has('title') ? 'is-invalid' : '' }}"
                           placeholder="Enter a compelling blog title…" required>
                    @error('title')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="field-label">Short Description <span class="req">*</span></label>
                    <textarea name="short_description" rows="2"
                              class="field-input {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                              placeholder="Brief summary shown on the listing page…" required>{{ old('short_description') }}</textarea>
                    @error('short_description')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Full Content <span class="req">*</span></label>
                    <textarea name="content" rows="12"
                              class="field-input {{ $errors->has('content') ? 'is-invalid' : '' }}"
                              placeholder="Write the full blog content here…" required>{{ old('content') }}</textarea>
                    @error('content')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Image upload --}}
        <div class="form-panel">
            <div class="form-panel-header">
                <i class="bi bi-image" style="color:#f59e0b"></i> Featured Image
            </div>
            <div class="form-panel-body">
                <div class="image-upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()">
                    <div id="uploadPlaceholder">
                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="upload-text">Click to upload an image</div>
                        <div class="upload-hint">PNG, JPG, WEBP up to 2MB</div>
                    </div>
                    <img id="imagePreview" src="#" alt="Preview"
                         class="d-none rounded" style="max-height:180px;max-width:100%">
                </div>
                <input type="file" id="imageInput" name="image" accept="image/*" class="d-none"
                       onchange="handleImageUpload(this)">
                @error('image')<div class="field-error mt-2">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- Sidebar settings --}}
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
                        <option value="">Choose category…</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="field-error">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="field-label">Publish Date</label>
                    <input type="date" name="published_at" value="{{ old('published_at') }}"
                           class="field-input {{ $errors->has('published_at') ? 'is-invalid' : '' }}">
                    @error('published_at')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="d-flex flex-column gap-2">
            <button type="submit" class="btn-submit w-100 justify-content-center">
                <i class="bi bi-send"></i> Publish Blog
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
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('uploadPlaceholder');
        const area = document.getElementById('uploadArea');
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('d-none');
        placeholder.classList.add('d-none');
        area.classList.add('has-file');
    }
}
</script>
@endpush
