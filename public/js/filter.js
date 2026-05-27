$(function () {

    // Set CSRF token on every AJAX request
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    let searchTimer = null;
    let activeCategory = 'all';

    // ── Fetch & render results ────────────────────────────────────────────────
    function fetchBlogs() {
        const params = {
            category : activeCategory,
            date     : $('#dateFilter').val(),
            search   : $('#searchInput').val().trim(),
        };

        $('#loading').show();
        $('#blog-results').hide();

        $.get(window.FILTER_URL, params)
            .done(function (html) {
                $('#blog-results').html(html).show();
            })
            .fail(function () {
                $('#blog-results')
                    .html('<p class="text-center text-danger py-5">Something went wrong. Please try again.</p>')
                    .show();
            })
            .always(function () {
                $('#loading').hide();
            });
    }

    // ── Category pills ────────────────────────────────────────────────────────
    $(document).on('click', '.filter-pill', function () {
        $('.filter-pill').removeClass('active');
        $(this).addClass('active');
        activeCategory = $(this).data('category');
        fetchBlogs();
    });

    // ── Date filter ───────────────────────────────────────────────────────────
    $('#dateFilter').on('change', function () {
        fetchBlogs();
    });

    // ── Search (debounced 400 ms) ─────────────────────────────────────────────
    $('#searchInput').on('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(fetchBlogs, 400);
    });

});
