@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
.stat-card {
    border-radius: 16px; border: none; overflow: hidden;
    position: relative; padding: 1.5rem;
    display: flex; flex-direction: column; gap: .5rem;
    min-height: 130px; transition: transform .25s, box-shadow .25s;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 12px 28px rgba(0,0,0,.12); }
.stat-card-icon {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.2rem; margin-bottom: .25rem;
}
.stat-card-value { font-size: 2.2rem; font-weight: 800; line-height: 1; letter-spacing: -1px; }
.stat-card-label { font-size: .8rem; font-weight: 500; opacity: .75; }
.stat-card-watermark {
    position: absolute; right: -8px; bottom: -12px;
    font-size: 5.5rem; opacity: .07; line-height: 1;
}

.panel {
    background: #fff; border-radius: 16px;
    border: 1px solid #e2e8f0; overflow: hidden;
}
.panel-header {
    padding: 1.1rem 1.4rem;
    border-bottom: 1px solid #f1f5f9;
    display: flex; align-items: center; justify-content: space-between;
}
.panel-header h6 { font-weight: 700; font-size: .9rem; margin: 0; color: #0f172a; }
.panel-body { padding: 0; }

.blog-row { display: flex; align-items: center; gap: 1rem; padding: .9rem 1.4rem; border-bottom: 1px solid #f8fafc; transition: background .15s; }
.blog-row:last-child { border-bottom: none; }
.blog-row:hover { background: #fafbff; }
.blog-row-thumb {
    width: 48px; height: 48px; border-radius: 10px; flex-shrink: 0;
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    overflow: hidden;
}
.blog-row-thumb img { width: 100%; height: 100%; object-fit: cover; }
.blog-row-title { font-size: .85rem; font-weight: 600; color: #0f172a; line-height: 1.4; }
.blog-row-meta { font-size: .75rem; color: #94a3b8; margin-top: .15rem; }
.cat-chip {
    font-size: .7rem; font-weight: 600;
    padding: .22rem .65rem; border-radius: 50px;
    background: #ede9fe; color: #7c3aed;
    white-space: nowrap;
}
.quick-btn {
    display: flex; align-items: center; gap: .6rem;
    padding: .7rem 1rem; border-radius: 12px;
    border: 1.5px solid #e2e8f0;
    background: #fff; color: #374151;
    font-size: .82rem; font-weight: 600;
    text-decoration: none;
    transition: all .2s; font-family: 'Inter', sans-serif;
}
.quick-btn:hover { border-color: #6366f1; color: #6366f1; background: #eef2ff; }
.quick-btn-icon {
    width: 30px; height: 30px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem;
}
</style>
@endpush

@section('content')

{{-- Stat cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#6366f1,#818cf8);color:#fff">
            <div class="stat-card-icon" style="background:rgba(255,255,255,.18)">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="stat-card-value">{{ $totalBlogs }}</div>
            <div class="stat-card-label">Total Blogs</div>
            <div class="stat-card-watermark"><i class="bi bi-file-earmark-text"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#e94560,#f97316);color:#fff">
            <div class="stat-card-icon" style="background:rgba(255,255,255,.18)">
                <i class="bi bi-tags"></i>
            </div>
            <div class="stat-card-value">{{ $totalCategories }}</div>
            <div class="stat-card-label">Categories</div>
            <div class="stat-card-watermark"><i class="bi bi-tags"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#10b981,#34d399);color:#fff">
            <div class="stat-card-icon" style="background:rgba(255,255,255,.18)">
                <i class="bi bi-eye"></i>
            </div>
            <div class="stat-card-value">âˆž</div>
            <div class="stat-card-label">Public Readers</div>
            <div class="stat-card-watermark"><i class="bi bi-eye"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#f59e0b,#fbbf24);color:#fff">
            <div class="stat-card-icon" style="background:rgba(255,255,255,.18)">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stat-card-value">{{ now()->format('M') }}</div>
            <div class="stat-card-label">Current Month</div>
            <div class="stat-card-watermark"><i class="bi bi-calendar-check"></i></div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Recent Blogs --}}
    <div class="col-lg-8">
        <div class="panel">
            <div class="panel-header">
                <h6><i class="bi bi-clock-history me-2" style="color:#6366f1"></i>Recent Blogs</h6>
                <a href="{{ route('admin.blogs.index') }}" style="font-size:.78rem;color:#6366f1;font-weight:600;text-decoration:none">
                    View all <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="panel-body">
                @forelse($recentBlogs as $blog)
                <div class="blog-row">
                    <div class="blog-row-thumb">
                        @if($blog->image)
                            <img src="{{ asset('storage/'.$blog->image) }}" alt="">
                        @endif
                    </div>
                    <div class="flex-grow-1 min-width-0">
                        <div class="blog-row-title">{{ Str::limit($blog->title, 52) }}</div>
                        <div class="blog-row-meta">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $blog->published_at?->format('d M Y') ?? 'â€”' }}
                        </div>
                    </div>
                    <span class="cat-chip">{{ $blog->category->name }}</span>
                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                       style="color:#94a3b8;font-size:.9rem;text-decoration:none;flex-shrink:0"
                       title="Edit"><i class="bi bi-pencil"></i></a>
                </div>
                @empty
                <div class="text-center text-muted py-5" style="font-size:.85rem">
                    No blogs yet. <a href="{{ route('admin.blogs.create') }}" style="color:#6366f1">Create one â†’</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick actions --}}
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-header">
                <h6><i class="bi bi-lightning-charge me-2" style="color:#f59e0b"></i>Quick Actions</h6>
            </div>
            <div class="panel-body p-3 d-flex flex-column gap-2">
                <a href="{{ route('admin.blogs.create') }}" class="quick-btn">
                    <div class="quick-btn-icon" style="background:#eef2ff;color:#6366f1">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    New Blog Post
                </a>
                <a href="{{ route('admin.categories.index') }}" class="quick-btn">
                    <div class="quick-btn-icon" style="background:#fff7ed;color:#f59e0b">
                        <i class="bi bi-tags"></i>
                    </div>
                    Manage Categories
                </a>
                <a href="{{ route('blogs.index') }}" target="_blank" class="quick-btn">
                    <div class="quick-btn-icon" style="background:#ecfdf5;color:#10b981">
                        <i class="bi bi-globe2"></i>
                    </div>
                    View Live Site
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

