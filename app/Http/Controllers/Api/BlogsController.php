<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
    public function latest()
    {
        $blogs = Blog::latest()->take(2)->get();
        foreach ($blogs as $blog) {
            $blog['image'] = $blog->getImageUrl();
        }

        return response()->json([
            'data' => $blogs
        ], 200);
    }

    public function index() {
        $blogs = Blog::all();
        foreach ($blogs as $blog) {
            $blog['image'] = $blog->getImageUrl();
        }
        return response()->json([
            'data' => $blogs
        ], 200);
    }

    public function show($slug) {
        $blog = Blog::where('slug', $slug)->get();
        foreach ($blog as $item) {
            $item['image'] = $item->getImageUrl();
        }

        return response()->json([
            'data' => $blog
        ], 200);
    }

}
