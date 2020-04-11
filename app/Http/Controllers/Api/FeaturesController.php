<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Features;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function latest()
    {
        $features = Features::latest()->get();
        return response()->json([
            'data' => $features
        ], 200);
    }

    public function index()
    {
        $features = Features::all();
        return response()->json([
            'data' => $features
        ], 200);
    }

}
