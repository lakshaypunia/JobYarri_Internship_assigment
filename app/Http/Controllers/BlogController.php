<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $blogs = Blog::with('category')->latest()->paginate(12);

        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function filter(Request $request)
    {
        $query = Blog::with('category');

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('short_description', 'like', "%{$term}%");
            });
        }

        $blogs = $query->latest()->paginate(12);

        return view('blogs.partials.card-grid', compact('blogs'));
    }
}
