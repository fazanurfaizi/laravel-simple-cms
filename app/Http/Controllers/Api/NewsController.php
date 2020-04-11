<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLatestNews()
    {
        $news = News::latest()->take(3)->get();
        return response()->json([
            'data' => $news
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $news = News::all();
        return response()->json([
            'data' => $news
        ], 200);
    }

    public function show($slug) {
        $news = News::where('slug', '=', $slug);
        if(!$news) {
            return response()->json([
                'message' => "Berita tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'data' => $news
        ]);
    }

}
