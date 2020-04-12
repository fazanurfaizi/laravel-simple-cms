<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use DataTables;
use Image;

class BlogsController extends Controller
{

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:blogs',
            'slug' => 'sometimes|string|unique:blogs',
            'body' => 'required|string',
            'image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->title = $request->title;
        $blog->slug = str_slug($request->title);
        $blog->body = $request->body;

        $imagePath = public_path('storage/images/blogs/');
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

    public function edit($id) {
        $data['blog'] = Blog::find($id);
        return view('admin.blogs.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required|string|unique:blogs',
            'slug' => 'sometimes|string|unique:blogs',
            'body' => 'required|string',
            'image' => 'sometimes|mimes:jpeg,jpg,png,gif|max:1000'
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = str_slug($request->title);
        $blog->body = $request->body;

        if($request->hasFile('image')) {
            $imagePath = public_path('storage/images/blogs/');
            $image = $request->image;
            $ext = $request->image->getClientOriginalExtension();
            $imageName = date('YmdHis') . rand(1, 999999) . '.' . $ext;
            $thumbnail = Image::make($image->getRealPath())->resize(512, 512);
            $thumbnailLocation = $imagePath . $imageName;
            $thumbnailImage = Image::make($thumbnail)->save($thumbnailLocation);

            if($blog->image != 'default-image.jpg') {
                unlink($imagePath . $blog->image);
            }

            $blog->image = $imageName;
        }

        $blog->save();

        return redirect('dashboard/blogs/')->with('success', 'Blog berhasil diedit');
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);

        if($blog->image != 'default-image.jpg') {
            $imagePath = public_path('storage/images/blogs/');
            unlink($imagePath . $blog->image);
        }

        $blog->delete();
        return redirect('/dashboard/blogs/')->with('success', 'Blog berhasil dihapus');
    }
}
