<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content'           => 'required|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content'           => 'required|string',
            'category_id'       => 'required|exists:categories,id',
            'image'             => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        } else {
            unset($data['image']);
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function uploadImage(Request $request)
    {
        try {
            // Jodit sends as files[0], but accept plain 'file' too
            $file = $request->file('file')
                ?? ($request->file('files') ? $request->file('files')[0] : null);

            if (!$file || !$file->isValid()) {
                return response()->json(['error' => 'No valid file received'], 422);
            }

            $url = $this->storeImage($file);
            return response()->json(['url' => $url]);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function storeImage(UploadedFile $file): string
    {
        $cloudName = config('services.cloudinary.cloud_name');

        if ($cloudName && $cloudName !== 'your_cloud_name') {
            return (new CloudinaryService())->upload($file);
        }

        return $file->store('blogs', 'public');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return back()->with('success', 'Blog deleted.');
    }
}
