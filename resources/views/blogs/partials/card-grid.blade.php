@forelse($blogs as $blog)
<div class="col-sm-6 col-lg-4">
    <div class="card blog-card shadow-sm h-100">
        @if($blog->image)
            <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}">
        @else
            <div class="card-img-placeholder">
                <i class="bi bi-journal-text fs-1 text-white opacity-50"></i>
            </div>
        @endif
        <div class="card-body d-flex flex-column">
            <div class="mb-2">
                <span class="category-badge">{{ $blog->category->name }}</span>
            </div>
            <h6 class="card-title fw-bold mb-1">{{ Str::limit($blog->title, 60) }}</h6>
            <p class="card-text text-muted small flex-grow-1">
                {{ Str::limit($blog->short_description, 100) }}
            </p>
            <div class="d-flex align-items-center justify-content-between mt-3">
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                </small>
                <a href="{{ route('blogs.show', $blog) }}" class="read-more">
                    Read More <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5">
        <i class="bi bi-search fs-1 text-muted"></i>
        <p class="text-muted mt-3">No blogs found. Try a different filter.</p>
    </div>
</div>
@endforelse

@if($blogs->hasPages())
<div class="col-12 mt-2">
    {{ $blogs->links() }}
</div>
@endif
