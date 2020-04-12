<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function latest()
    {
        $features = Features::latest()->take(5)->get();
        foreach ($features as $item) {
            $item['image'] = $item->getImageUrl();
        }

        return response()->json([
            'data' => $features
        ], 200);
    }

    public function index()
    {
        $features = Features::all();
        foreach ($features as $item) {
            $item['image'] = $item->getImageUrl();
        }

        return response()->json([
            'data' => $features
        ], 200);
    }

}
