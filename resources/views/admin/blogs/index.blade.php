@extends('layouts.admin')

@section('title', 'Blogs')
@section('page-title', 'Manage Blogs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted">{{ $blogs->total() }} blogs total</span>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Add Blog
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width:80px">Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td>
                        @if($blog->image)
                            <img src="{{ asset('storage/'.$blog->image) }}"
                                 class="rounded" width="60" height="45" style="object-fit:cover">
                        @else
                            <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                 style="width:60px;height:45px">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="fw-semibold">{{ Str::limit($blog->title, 55) }}</div>
                        <small class="text-muted">{{ Str::limit($blog->short_description, 70) }}</small>
                    </td>
                    <td><span class="badge bg-secondary">{{ $blog->category->name }}</span></td>
                    <td class="text-nowrap">{{ $blog->published_at?->format('d M Y') ?? '—' }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                           class="btn btn-sm btn-outline-primary me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete this blog?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-5">
                        No blogs yet. <a href="{{ route('admin.blogs.create') }}">Add one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
    <div class="card-footer bg-white">
        {{ $blogs->links() }}
    </div>
    @endif
</div>
@endsection
