<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use DataTables;
use Image;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.blogs.index');
    }

    public function json() {
        return DataTables::of(Blog::query())
            ->addColumn('edit_url', function($row) {
                return url('dashboard/blogs/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/blogs/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create() {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->title;
        $blog->slug = str_slug($request->title);
        $blog->body = $request->body;

        $imagePath = public_path('/images/blogs/');
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
            $blog->image = $imageName;
        } else {
            $blog->image = 'default-image.jpg';
        }

        $blog->save();

        return redirect('/dashboard/blogs/')->with('success', 'Blog berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    public function edit($id) {
        $data['blog'] = Blog::find($id);
        return view('admin.blogs.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);

        $blog->title = $request->title;
        $blog->body = $request->body;
        $blog->slug = str_slug($request->title);

        if($request->hasFile('image')) {
            $imagePath = public_path('/images/blogs/');
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);
            $blog->image = $imageName;
        }

        $blog->save();

        return redirect('dashboard/blogs/')->with('success', 'Blog berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/dashboard/blogs/')->with('success', 'Blog berhasil dihapus');
    }
}
