@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:#fff3cd">
                    <i class="bi bi-file-earmark-text fs-3 text-warning"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $totalBlogs }}</div>
                    <div class="text-muted small">Total Blogs</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:#d1e7dd">
                    <i class="bi bi-tags fs-3 text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold">{{ $totalCategories }}</div>
                    <div class="text-muted small">Categories</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-semibold">Recent Blogs</div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Published</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBlogs as $blog)
                <tr>
                    <td>{{ Str::limit($blog->title, 50) }}</td>
                    <td><span class="badge bg-secondary">{{ $blog->category->name }}</span></td>
                    <td>{{ $blog->published_at?->format('d M Y') ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center text-muted py-3">No blogs yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
