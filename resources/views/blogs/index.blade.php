@extends('layouts.app')

@section('title', 'All Blogs')

@section('content')

{{-- Hero --}}
<section class="hero">
    <div class="container">
        <h1><i class="bi bi-newspaper me-2"></i>Latest Updates</h1>
        <p class="mb-4">Admit cards, results, answer keys, syllabus &amp; job notifications — all in one place.</p>

        {{-- Search bar --}}
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control search-input"
                           placeholder="Search blogs...">
                    <button class="btn search-btn" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Filters --}}
<div class="bg-white border-bottom py-3 sticky-top" style="top:56px;z-index:90">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button class="filter-pill active" data-category="all">All</button>
            @foreach($categories as $category)
                <button class="filter-pill" data-category="{{ $category->id }}">
                    {{ $category->name }}
                </button>
            @endforeach
            <div class="ms-auto d-flex align-items-center gap-2">
                <label class="text-muted small mb-0">Date:</label>
                <input type="date" id="dateFilter" class="form-control form-control-sm" style="width:160px">
            </div>
        </div>
    </div>
</div>

{{-- Blog Grid --}}
<div class="container py-4">
    {{-- Loading spinner --}}
    <div id="loading" class="text-center py-5">
        <div class="spinner-border text-danger" role="status"></div>
        <p class="text-muted mt-2">Loading blogs...</p>
    </div>

    <div id="blog-results">
        <div class="row g-4">
            @include('blogs.partials.card-grid')
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/filter.js') }}"></script>
@endpush
