<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;

class ServicesController extends Controller
{

    public function hukum() {
        $layanan = Layanan::where('type', '=', 'hukum')->orderBy('created_at', 'desc')->take(1)->get();
        return response()->json([
            'data' => $layanan
        ], 200);
    }

    public function publik() {
        $layanan = Layanan::where('type', '=', 'publik')->orderBy('created_at', 'desc')->take(1)->get();
        return response()->json([
            'data' => $layanan
        ], 200);
    }

    public function information() {
        $layanan = Layanan::where('type', '=', 'info')->orderBy('created_at', 'desc')->take(1)->get();
        return response()->json([
            'data' => $layanan
        ], 200);
    }

    public function about() {
        $layanan = Layanan::where('type', '=', 'about')->orderBy('created_at', 'desc')->take(1)->get();
        return response()->json([
            'data' => $layanan
        ], 200);
    }

}
