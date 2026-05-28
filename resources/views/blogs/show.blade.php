@extends('layouts.app')

@section('title', $blog->title)

@push('styles')
<style>
    .article-hero {
        position: relative;
        height: clamp(220px, 38vw, 460px);
        overflow: hidden;
        background: var(--navy);
    }
    .article-hero img {
        width: 100%; height: 100%;
        object-fit: cover;
        opacity: .55;
        transition: transform 8s ease;
    }
    .article-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, transparent 40%, rgba(15,23,42,.9) 100%);
    }
    .article-hero-placeholder {
        height: 100%;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
    }
    .article-title-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        z-index: 2;
        padding: 2rem;
    }

    .article-body {
        font-size: 1.06rem;
        line-height: 1.9;
        color: #334155;
    }
    .article-body p  { margin-bottom: 1.25rem; }
    .article-body h1,.article-body h2,.article-body h3,
    .article-body h4,.article-body h5,.article-body h6 {
        font-weight: 700; color: #0f172a; margin: 1.75rem 0 .75rem;
    }
    .article-body h1 { font-size: 1.7rem; }
    .article-body h2 { font-size: 1.4rem; }
    .article-body h3 { font-size: 1.2rem; }
    .article-body ul, .article-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
    .article-body li { margin-bottom: .35rem; }
    .article-body strong { font-weight: 700; color: #0f172a; }
    .article-body a { color: var(--accent); text-decoration: underline; }
    .article-body blockquote {
        border-left: 3px solid var(--accent); padding-left: 1rem;
        color: #64748b; font-style: italic; margin: 1.5rem 0;
    }
    .article-body table {
        width: 100%; border-collapse: collapse; margin-bottom: 1.25rem; font-size: .95rem;
    }
    .article-body table th, .article-body table td {
        border: 1px solid #e2e8f0; padding: .6rem .9rem; text-align: left;
    }
    .article-body table th { background: #f8fafc; font-weight: 700; color: #0f172a; }
    .article-body table tr:nth-child(even) td { background: #fafbff; }
    .article-body pre {
        background: #1e293b; color: #e2e8f0; padding: 1rem 1.25rem;
        border-radius: 10px; overflow-x: auto; font-size: .88rem; margin-bottom: 1.25rem;
    }
    .article-body img { max-width: 100%; border-radius: 10px; margin: 1rem 0; }

    .article-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
    }
    .article-sidebar .sticky-lg-top { top: 90px; }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        font-size: .82rem;
        font-weight: 600;
        color: var(--text-muted);
        text-decoration: none;
        padding: .45rem .9rem;
        border: 1.5px solid var(--border);
        border-radius: 50px;
        transition: all .2s;
    }
    .back-btn:hover {
        color: var(--accent);
        border-color: var(--accent);
        background: rgba(233,69,96,.04);
    }

    .article-divider {
        height: 3px;
        width: 48px;
        background: var(--accent);
        border-radius: 2px;
        margin: 1.5rem 0;
    }

    .meta-chip {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        font-size: .78rem;
        color: var(--text-muted);
        background: var(--surface);
        border: 1px solid var(--border);
        padding: .3rem .8rem;
        border-radius: 50px;
    }
</style>
@endpush

@section('content')

{{-- â”€â”€ Hero â”€â”€ --}}
<div class="article-hero">
    @if($blog->image)
        <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
        <div class="article-title-overlay">
            <div class="container">
                <span class="category-badge mb-2 d-inline-block">{{ $blog->category->name }}</span>
                <h1 class="text-white fw-800 mb-0"
                    style="font-size:clamp(1.3rem,3.5vw,2.2rem);line-height:1.25;font-weight:800;letter-spacing:-.5px;max-width:700px">
                    {{ $blog->title }}
                </h1>
            </div>
        </div>
    @else
        <div class="article-hero-placeholder d-flex align-items-end">
            <div class="container pb-4">
                <span class="category-badge mb-2 d-inline-block">{{ $blog->category->name }}</span>
                <h1 class="text-white fw-800 mb-0"
                    style="font-size:clamp(1.3rem,3.5vw,2.2rem);line-height:1.25;font-weight:800;letter-spacing:-.5px;max-width:700px">
                    {{ $blog->title }}
                </h1>
            </div>
        </div>
    @endif
</div>

{{-- â”€â”€ Article body â”€â”€ --}}
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Back + meta --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                <a href="{{ route('blogs.index') }}" class="back-btn">
                    <i class="bi bi-arrow-left"></i> All Blogs
                </a>
                <div class="d-flex gap-2 flex-wrap">
                    <span class="meta-chip">
                        <i class="bi bi-calendar3"></i>
                        {{ $blog->created_at->format('d M Y') }}
                    </span>
                    <span class="meta-chip">
                        <i class="bi bi-tag"></i>
                        {{ $blog->category->name }}
                    </span>
                </div>
            </div>

            {{-- Article card --}}
            <div class="article-card p-4 p-md-5">
                <p class="mb-0" style="font-size:1.1rem;color:#64748b;line-height:1.75;font-style:italic;border-left:3px solid var(--accent);padding-left:1.25rem">
                    {{ $blog->short_description }}
                </p>

                <div class="article-divider"></div>

                <div class="article-body">
                    {!! $blog->content !!}
                </div>
            </div>

            {{-- Bottom nav --}}
            <div class="mt-4">
                <a href="{{ route('blogs.index') }}" class="back-btn">
                    <i class="bi bi-arrow-left"></i> Back to All Blogs
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

