<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Features;
use DataTables;
use Image;

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
        $features = new Features;
        $features->user_id = auth()->user()->id;
        $features->title = $request->title;
        $features->slug = isset($request->slug) ? $request->slug : str_slug($request->title);
        $features->body = $request->body;

        $imagePath = public_path('/images/features/');
        if(!file_exists($imagePath)) {
            mkdir($imagePath, 666, true);
        }

        if($request->hasFile('image')) {
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);
            $features->image = $imageName;
        } else {
            $features->image = 'default-image.jpg';
        }

        $features->save();

        return redirect('/dashboard/features/')->with('success', 'Fitur berhasil ditambahkan');
    }

    public function edit($id) {
        $features = Features::find($id);
        $data['features'] = $features;
        return view('admin.features.edit', $data);
    }

    public function update(Request $request, $id) {
        $features = Features::find($id);

        $features->title = $request->title;
        $features->slug = isset($request->slug) ? $request->slug : str_slug($request->title);
        $features->body = $request->body;

        if($request->hasFile('image')) {
            $imagePath = public_path('/images/features/');
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);
            $features->image = $imageName;
        }

        $features->save();

        return redirect('/dashboard/features/')->with('success', 'Fitur berhasil diedit');
    }

    public function destroy($id) {
        $features = Features::find($id);
        $features->delete();
        return redirect('/dashboard/features/')->with('success', 'Fitur berhasil dihapus');
    }

}
