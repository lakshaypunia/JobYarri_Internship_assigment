@extends('layouts.admin')
@section('title', 'Categories')
@section('page-title', 'Categories')

@push('styles')
<style>
.field-label { font-size:.8rem;font-weight:600;color:#374151;margin-bottom:.4rem;display:block; }
.req { color:#ef4444; }
.field-input { width:100%;padding:.7rem 1rem;border:1.5px solid #e2e8f0;border-radius:10px;font-size:.875rem;font-family:'Inter',sans-serif;color:#0f172a;background:#f8fafc;transition:border .2s,box-shadow .2s;outline:none; }
.field-input:focus { border-color:#6366f1;background:#fff;box-shadow:0 0 0 4px rgba(99,102,241,.08); }
.field-input.is-invalid { border-color:#ef4444; }
.field-error { font-size:.75rem;color:#ef4444;margin-top:.3rem; }
.btn-add { display:flex;align-items:center;justify-content:center;gap:.5rem;width:100%;padding:.7rem;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;font-size:.875rem;font-weight:700;font-family:'Inter',sans-serif;cursor:pointer;transition:opacity .2s; }
.btn-add:hover { opacity:.9; }

.panel { background:#fff;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden; }
.panel-header { padding:1.1rem 1.4rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between; }
.panel-header h6 { font-size:.9rem;font-weight:700;color:#0f172a;margin:0; }

.cat-row { display:flex;align-items:center;gap:1rem;padding:.85rem 1.4rem;border-bottom:1px solid #f8fafc;transition:background .15s; }
.cat-row:last-child { border-bottom:none; }
.cat-row:hover { background:#fafbff; }
.cat-icon { width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,#eef2ff,#e0e7ff);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:#6366f1;font-size:.95rem; }
.cat-name { font-size:.875rem;font-weight:600;color:#0f172a; }
.cat-slug { font-size:.73rem;color:#94a3b8;font-family:monospace; }
.cat-count { font-size:.75rem;font-weight:600;padding:.2rem .65rem;background:#f1f5f9;border-radius:50px;color:#64748b;white-space:nowrap;flex-shrink:0; }
.del-btn { width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;border:1px solid #fee2e2;background:#fff5f5;color:#ef4444;cursor:pointer;transition:all .15s;flex-shrink:0; }
.del-btn:hover { background:#ef4444;color:#fff;border-color:#ef4444; }
</style>
@endpush

@section('content')
<div class="row g-3">

    {{-- Add form --}}
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-header">
                <h6><i class="bi bi-plus-circle me-2" style="color:#6366f1"></i>New Category</h6>
            </div>
            <div class="p-4">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="field-label">Category Name <span class="req">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="e.g. Admit Card" required>
                        @error('name')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn-add">
                        <i class="bi bi-plus-lg"></i> Add Category
                    </button>
                </form>

                <div class="mt-4 pt-4" style="border-top:1px solid #f1f5f9">
                    <p style="font-size:.78rem;color:#94a3b8;margin:0;line-height:1.6">
                        <i class="bi bi-info-circle me-1"></i>
                        The slug is auto-generated from the name. Deleting a category will also remove all associated blogs.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Category list --}}
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-header">
                <h6><i class="bi bi-tags me-2" style="color:#6366f1"></i>All Categories</h6>
                <span style="font-size:.78rem;color:#94a3b8">{{ $categories->count() }} total</span>
            </div>
            @forelse($categories as $category)
            <div class="cat-row">
                <div class="cat-icon"><i class="bi bi-tag"></i></div>
                <div class="flex-grow-1">
                    <div class="cat-name">{{ $category->name }}</div>
                    <div class="cat-slug">/{{ $category->slug }}</div>
                </div>
                <span class="cat-count">{{ $category->blogs_count }} blogs</span>
                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                      onsubmit="return confirm('Delete category: {{ $category->name }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="del-btn" title="Delete">
                        <i class="bi bi-trash" style="font-size:.8rem"></i>
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center py-5" style="color:#94a3b8">
                <i class="bi bi-tags" style="font-size:2rem;opacity:.3"></i>
                <p class="mt-2 mb-0" style="font-size:.85rem">No categories yet. Add one.</p>
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
