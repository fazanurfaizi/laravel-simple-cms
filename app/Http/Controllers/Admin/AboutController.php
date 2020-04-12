<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class AboutController extends Controller
{

    public function index()
    {
        return view('admin.layanan.about.index');
    }

    public function json() {
        return DataTables::of(Layanan::where('type', 'about'))
            ->addColumn('edit_url', function($row) {
                return url('dashboard/about/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/about/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.layanan.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'string|required',
            'body' => 'string|required'
        ]);

        $about = new Layanan();
        $about->type = $request->type;
        $about->body = $request->body;
        $about->save();

        return redirect('/dashboard/about')->with('success', 'About Page berhasil ditambahkan');
    }

    public function edit($id)
    {
        $about = Layanan::find($id);
        $data['about'] = $about;
        return view('admin.layanan.about.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'string|required',
            'body' => 'string|required'
        ]);

        $about = Layanan::find($id);
        $about->type = $request->type;
        $about->body = $request->body;
        $about->save();
        return redirect('/dashboard/about')->with('success', 'About Page berhasil diubah');
    }

    public function destroy($id)
    {
        $about = Layanan::find($id);
        $about->delete();
        return redirect('/dashboard/about')->with('success', 'About Page berhasil dihapus');
    }
}
