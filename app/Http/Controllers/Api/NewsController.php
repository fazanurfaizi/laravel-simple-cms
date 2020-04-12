<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function latest()
    {
        $news = News::latest()->get();
        foreach ($news as $item) {
            $item['image'] = $item->getImageUrl();
        }

        return response()->json([
            'data' => $news
        ], 200);
    }

    public function index()
    {
        $news = News::all();
        foreach ($news as $item) {
            $item['image'] = $item->getImageUrl();
        }

        return response()->json([
            'data' => $news
        ], 200);
    }

}
