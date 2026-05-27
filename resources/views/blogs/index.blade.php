@extends('layouts.app')

@section('title', 'All Blogs')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-grid"></div>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-eyebrow">
                    <i class="bi bi-lightning-charge-fill"></i> Live Updates
                </div>
                <h1>
                    Your Gateway to<br>
                    <span class="highlight">Government Updates</span>
                </h1>
                <p class="mb-4">
                    Admit cards, results, answer keys, syllabus & job notifications —
                    all in one place, always up to date.
                </p>

                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Search blogs, exams, results…">
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-end">
                <div class="d-flex flex-column gap-3" style="opacity:.7">
                    @foreach($categories->take(4) as $cat)
                    <div class="d-flex align-items-center gap-2 text-white">
                        <div style="width:6px;height:6px;background:var(--accent);border-radius:50%"></div>
                        <span style="font-size:.85rem">{{ $cat->name }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Filter Bar ───────────────────────────────────────────────── --}}
<div class="filter-bar sticky-top">
    <div class="container">
        <div class="d-flex align-items-center gap-3 flex-wrap flex-md-nowrap">
            <div class="pills-scroll flex-grow-1">
                <button class="filter-pill active" data-category="all">
                    <i class="bi bi-grid-3x3-gap me-1"></i>All
                </button>
                @foreach($categories as $category)
                    <button class="filter-pill" data-category="{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            <div class="flex-shrink-0">
                <input type="date" id="dateFilter" title="Filter by date">
            </div>
        </div>
    </div>
</div>

{{-- ── Blog Grid ────────────────────────────────────────────────── --}}
<div class="container py-5">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="section-heading">Latest Posts</span>
        </div>
    </div>

    {{-- Loading spinner --}}
    <div id="loading" class="text-center py-5">
        <div class="spinner-border" role="status" style="width:2.5rem;height:2.5rem"></div>
        <p class="text-muted mt-3 small">Fetching results…</p>
    </div>

    <div id="blog-results">
        @include('blogs.partials.card-grid')
    </div>
</div>

@endsection

@push('scripts')
<script>window.FILTER_URL = "{{ route('blogs.filter') }}";</script>
<script src="{{ asset('js/filter.js') }}"></script>
@endpush
