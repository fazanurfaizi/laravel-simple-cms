<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Features;
use DataTables;

class FeaturesController extends Controller
{

    public function index() {
        return view('admin.features.index');
    }

    public function json() {
        return DataTables::of(Features::query())
            ->addColumn('edit_url', function($row) {
                return url('dashboard/features/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/features/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create() {
        return view('admin.features.create');
    }

    public function store(Request $request) {

    }

}
