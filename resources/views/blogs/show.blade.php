@extends('layouts.app')

@section('title', $blog->title)

@section('content')

{{-- Hero image --}}
@if($blog->image)
<div style="height:380px;overflow:hidden;background:#1a1a2e">
    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}"
         style="width:100%;height:100%;object-fit:cover;opacity:.8">
</div>
@else
<div style="height:220px;background:linear-gradient(135deg,#1a1a2e,#0f3460)"></div>
@endif

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Back button --}}
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm mb-4">
                <i class="bi bi-arrow-left me-1"></i> Back to Blogs
            </a>

            {{-- Meta --}}
            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                <span class="category-badge">{{ $blog->category->name }}</span>
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                </small>
            </div>

            <h1 class="fw-bold mb-3" style="font-size:1.9rem;line-height:1.3">{{ $blog->title }}</h1>
            <p class="lead text-muted border-start border-4 ps-3 mb-4" style="border-color:#e94560 !important">
                {{ $blog->short_description }}
            </p>

            <hr>

            {{-- Full content --}}
            <div class="blog-content mt-4" style="line-height:1.9;font-size:1.05rem">
                {!! nl2br(e($blog->content)) !!}
            </div>

            <hr class="mt-5">

            <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Blogs
            </a>

        </div>
    </div>
</div>

@endsection
