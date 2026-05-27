<div class="row g-4">
@forelse($blogs as $blog)
<div class="col-sm-6 col-xl-4">
    <a href="{{ route('blogs.show', $blog) }}" class="bc-link">
        <article class="bc">
            {{-- Thumbnail --}}
            <div class="bc-thumb">
                @if($blog->image)
                    <img src="{{ asset('storage/'.$blog->image) }}" alt="{{ $blog->title }}" loading="lazy">
                @else
                    <div class="bc-thumb-placeholder">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                            <rect x="3" y="3" width="18" height="18" rx="3" stroke="rgba(255,255,255,.15)" stroke-width="1.5"/>
                            <path d="M3 9h18M9 21V9" stroke="rgba(255,255,255,.15)" stroke-width="1.5"/>
                        </svg>
                    </div>
                @endif
                <div class="bc-thumb-overlay"></div>
                <span class="bc-badge">{{ $blog->category->name }}</span>
                <div class="bc-thumb-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </div>
            </div>

            {{-- Body --}}
            <div class="bc-body">
                <h3 class="bc-title">{{ Str::limit($blog->title, 68) }}</h3>
                <p class="bc-excerpt">{{ Str::limit($blog->short_description, 100) }}</p>
                <div class="bc-footer">
                    <div class="bc-date">
                        <i class="bi bi-calendar3"></i>
                        {{ $blog->published_at?->format('d M Y') ?? $blog->created_at->format('d M Y') }}
                    </div>
                    <span class="bc-cta">Read <i class="bi bi-arrow-right"></i></span>
                </div>
            </div>

            {{-- Hover accent line --}}
            <div class="bc-accent-line"></div>
        </article>
    </a>
</div>
@empty
<div class="col-12">
    <div class="bc-empty">
        <div class="bc-empty-icon">
            <i class="bi bi-search"></i>
        </div>
        <h6>No blogs found</h6>
        <p>Try adjusting your search or filter.</p>
    </div>
</div>
@endforelse
</div>

@if($blogs->hasPages())
<div class="mt-5 d-flex justify-content-center">
    {{ $blogs->links() }}
</div>
@endif

<style>
.bc-link { text-decoration: none; display: block; height: 100%; }

.bc {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,.07);
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
    transition: transform .32s cubic-bezier(.34,1.56,.64,1), box-shadow .32s ease;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.bc:hover {
    transform: translateY(-8px);
    box-shadow: 0 28px 48px rgba(0,0,0,.13);
}

/* Thumbnail */
.bc-thumb {
    position: relative;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, #0f172a, #1e3a5f);
    flex-shrink: 0;
}
.bc-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform .5s cubic-bezier(.4,0,.2,1);
    display: block;
}
.bc:hover .bc-thumb img { transform: scale(1.07); }

.bc-thumb-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 60%, #0f3460 100%);
}

.bc-thumb-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0) 0%,
        rgba(0,0,0,.02) 60%,
        rgba(0,0,0,.45) 100%
    );
    transition: opacity .3s;
}
.bc:hover .bc-thumb-overlay { opacity: .8; }

/* Badge */
.bc-badge {
    position: absolute;
    top: 14px; left: 14px;
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(8px);
    color: #e94560;
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    padding: .28rem .75rem;
    border-radius: 50px;
    box-shadow: 0 2px 10px rgba(0,0,0,.15);
    border: 1px solid rgba(255,255,255,.6);
}

/* Arrow icon on hover */
.bc-thumb-arrow {
    position: absolute;
    bottom: 14px; right: 14px;
    width: 36px; height: 36px;
    background: var(--accent, #e94560);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: .9rem;
    opacity: 0;
    transform: scale(.7) rotate(-45deg);
    transition: opacity .25s, transform .3s cubic-bezier(.34,1.56,.64,1);
}
.bc:hover .bc-thumb-arrow {
    opacity: 1;
    transform: scale(1) rotate(0);
}

/* Body */
.bc-body {
    padding: 1.4rem 1.4rem 1.2rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}
.bc-title {
    font-size: .97rem;
    font-weight: 700;
    line-height: 1.5;
    color: #0f172a;
    margin-bottom: .6rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.bc-excerpt {
    font-size: .82rem;
    color: #64748b;
    line-height: 1.65;
    flex-grow: 1;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.bc-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 1.1rem;
    padding-top: .9rem;
    border-top: 1px solid #f1f5f9;
}
.bc-date {
    font-size: .75rem;
    color: #94a3b8;
    display: flex;
    align-items: center;
    gap: .35rem;
}
.bc-cta {
    font-size: .78rem;
    font-weight: 700;
    color: #e94560;
    display: inline-flex;
    align-items: center;
    gap: .3rem;
    transition: gap .2s;
}
.bc:hover .bc-cta { gap: .55rem; }

/* Bottom accent line */
.bc-accent-line {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #e94560, #f97316);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .35s cubic-bezier(.4,0,.2,1);
}
.bc:hover .bc-accent-line { transform: scaleX(1); }

/* Empty state */
.bc-empty {
    text-align: center;
    padding: 5rem 2rem;
}
.bc-empty-icon {
    width: 80px; height: 80px;
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 1.8rem;
    color: #94a3b8;
}
.bc-empty h6 { font-weight: 700; color: #1e293b; margin-bottom: .4rem; }
.bc-empty p { color: #94a3b8; font-size: .85rem; margin: 0; }
</style>

