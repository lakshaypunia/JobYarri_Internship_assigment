@extends('layouts.admin')
@section('title', 'Blogs')
@section('page-title', 'Blog Management')

@push('styles')
<style>
.page-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.25rem; flex-wrap: wrap; gap: .75rem;
}
.page-header-left h5 { font-weight: 800; font-size: 1.05rem; margin: 0; color: #0f172a; }
.page-header-left p { font-size: .8rem; color: #64748b; margin: .2rem 0 0; }
.btn-primary-custom {
    display: inline-flex; align-items: center; gap: .5rem;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff; border: none; border-radius: 10px;
    padding: .6rem 1.2rem; font-size: .85rem; font-weight: 600;
    font-family: 'Inter', sans-serif; cursor: pointer;
    text-decoration: none; transition: opacity .2s, transform .15s;
}
.btn-primary-custom:hover { opacity: .9; transform: translateY(-1px); color: #fff; }

.data-panel {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0; overflow: hidden;
}
.data-panel-header {
    padding: 1rem 1.25rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex; align-items: center; gap: .5rem;
    font-size: .82rem; color: #64748b;
}
.blog-item {
    display: flex; align-items: center; gap: 1rem;
    padding: .9rem 1.25rem;
    border-bottom: 1px solid #f8fafc;
    transition: background .15s;
}
.blog-item:last-child { border-bottom: none; }
.blog-item:hover { background: #fafbff; }
.blog-thumb {
    width: 56px; height: 42px; border-radius: 10px;
    flex-shrink: 0; overflow: hidden;
    background: linear-gradient(135deg, #1e293b, #1e3a5f);
    display: flex; align-items: center; justify-content: center;
}
.blog-thumb img { width: 100%; height: 100%; object-fit: cover; }
.blog-item-title { font-size: .875rem; font-weight: 600; color: #0f172a; line-height: 1.4; }
.blog-item-sub { font-size: .75rem; color: #94a3b8; margin-top: .15rem; }
.cat-pill {
    font-size: .7rem; font-weight: 600; padding: .22rem .7rem;
    border-radius: 50px; background: #ede9fe; color: #7c3aed;
    white-space: nowrap; flex-shrink: 0;
}
.action-btn {
    width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
    display: inline-flex; align-items: center; justify-content: center;
    border: 1px solid #e2e8f0; background: #fff; color: #64748b;
    cursor: pointer; transition: all .15s; text-decoration: none;
    font-size: 13px; line-height: 1; overflow: hidden;
}
.action-btn i { font-size: 13px; line-height: 1; display: block; }
.action-btn.edit:hover { border-color: #6366f1; background: #eef2ff; color: #6366f1; }
.action-btn.del:hover  { border-color: #ef4444; background: #fef2f2; color: #ef4444; }
.blog-thumb i { font-size: 1.1rem; line-height: 1; }

.pagination-wrap {
    padding: .85rem 1.25rem;
    border-top: 1px solid #f1f5f9;
}
.pagination-wrap .pagination {
    margin: 0;
    gap: .2rem;
}
.pagination-wrap .page-link {
    font-size: .78rem;
    padding: .35rem .7rem;
    border-radius: 8px !important;
    border: 1px solid #e2e8f0;
    color: #6366f1;
    line-height: 1.5;
}
.pagination-wrap .page-link:hover {
    background: #eef2ff;
    border-color: #6366f1;
    color: #6366f1;
}
.pagination-wrap .page-item.active .page-link {
    background: #6366f1;
    border-color: #6366f1;
    color: #fff;
}
.pagination-wrap .page-item.disabled .page-link {
    color: #cbd5e1;
    border-color: #f1f5f9;
    background: #f8fafc;
}
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-header-left">
        <h5>All Blogs</h5>
        <p>{{ $blogs->total() }} posts total</p>
    </div>
    <a href="{{ route('admin.blogs.create') }}" class="btn-primary-custom">
        <i class="bi bi-plus-lg"></i> New Blog
    </a>
</div>

<div class="data-panel">
    <div class="data-panel-header">
        <i class="bi bi-file-earmark-text"></i>
        Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ $blogs->total() }} blogs
    </div>

    @forelse($blogs as $blog)
    <div class="blog-item">
        <div class="blog-thumb">
            @if($blog->image)
                <img src="{{ $blog->image_url }}" alt="">
            @else
                <i class="bi bi-image" style="color:rgba(255,255,255,.2)"></i>
            @endif
        </div>
        <div class="flex-grow-1" style="min-width:0">
            <div class="blog-item-title">{{ Str::limit($blog->title, 60) }}</div>
            <div class="blog-item-sub">
                <i class="bi bi-calendar3 me-1"></i>
                {{ $blog->created_at->format('d M Y') }}
            </div>
        </div>
        <span class="cat-pill d-none d-md-inline">{{ $blog->category->name }}</span>
        <div class="d-flex gap-1">
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="action-btn edit" title="Edit">
                <i class="bi bi-pencil"></i>
            </a>
            <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}"
                  onsubmit="return confirm('Delete this blog?')">
                @csrf @method('DELETE')
                <button class="action-btn del" title="Delete" type="submit">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="text-center py-5" style="color:#94a3b8">
        <i class="bi bi-file-earmark-text" style="font-size:2.5rem;opacity:.3"></i>
        <p class="mt-3 mb-1" style="font-weight:600;color:#64748b">No blogs yet</p>
        <a href="{{ route(‘admin.blogs.create’) }}" style="font-size:.85rem;color:#6366f1;font-weight:600">Create your first blog &rarr;</a>
    </div>
    @endforelse

    @if($blogs->hasPages())
    <div class="pagination-wrap">{{ $blogs->links() }}</div>
    @endif
</div>
@endsection

