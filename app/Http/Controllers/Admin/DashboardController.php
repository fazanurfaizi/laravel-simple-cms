<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Features;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index() {
        $data = [
            'totalNews' => count(News::all()),
            'totalFeatures' => count(Features::all()),
            'totalBlogs' => count(Blog::all())
        ];
        return view('admin.dashboard', $data);
    }
}
