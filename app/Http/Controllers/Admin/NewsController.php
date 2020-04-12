<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use DataTables;
use Image;

class NewsController extends Controller
{

    public function index()
    {
        return view('admin.news.index');
    }

    public function json() {
        return DataTables::of(News::query())
            ->addColumn('edit_url', function($row) {
                return url('dashboard/news/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/news/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'sometimes|string|unique:news',
            'body' => 'required|string',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif'
        ]);

        $news = New News();
        $news->user_id = auth()->user()->id;
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        $news->body = $request->body;


        $imagePath = public_path('storage/images/news/');
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
            $news->image = $imageName;
        } else {
            $news->image = 'default-news.jpg';
        }

        $news->save();

        return redirect('dashboard/news/')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $news = News::find($id);
        $data['news'] = $news;
        return view('admin.news.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'sometimes|string|unique:news',
            'body' => 'required|string',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif'
        ]);

        $news = News::find($id);
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        $news->body = $request->body;

        if($request->hasFile('image')) {
            $imagePath = public_path('storage/images/news/');
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);

            if($news->image != 'default-image.jpg') {
                unlink($imagePath . $news->image);
            }

            $news->image = $imageName;
        }

        $news->save();

        return redirect('dashboard/news/')->with('success', 'Berita berhasil diedit');
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if($news->image != 'default-image.jpg') {
            $imagePath = public_path('storage/images/news/');
            unlink($imagePath . $news->image);
        }

        $news->delete();
        return redirect('dashboard/news/')->with('success', 'Berita berhasil dihapus');
    }
}
