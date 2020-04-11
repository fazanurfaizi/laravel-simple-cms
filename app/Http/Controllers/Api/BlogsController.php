<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
    public function latest()
    {
        $blogs = Blog::latest()->get();
        return response()->json([
            'data' => $blogs
        ], 200);
    }

    public function index() {
        $blogs = Blog::all();
        return response()->json([
            'data' => $blogs
        ], 200);
    }

}
