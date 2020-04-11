<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use DataTables;
use Image;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = New News();
        $news->user_id = auth()->user()->id;
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        $news->body = $request->body;

        $storagePath = public_path('/storage');
        if(!file_exists($storagePath)) {
            Artisan::call('storage:link');
        }

        $imagePath = public_path('/storage/images/news/');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $data['news'] = $news;
        return view('admin.news.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id);

        $news->title = $request->title;
        $news->body = $request->body;
        $news->slug = str_slug($request->title);

        if($request->hasFile('image')) {
            $imagePath = public_path('/storage/images/news/');
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);
            $news->image = $imageName;
        }

        $news->save();

        return redirect('dashboard/news/')->with('success', 'Berita berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect('dashboard/news/')->with('success', 'Berita berhasil dihapus');
    }
}
