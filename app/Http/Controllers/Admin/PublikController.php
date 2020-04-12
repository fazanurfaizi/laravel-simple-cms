<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class PublikController extends Controller
{

    public function index()
    {
        return view('admin.layanan.publik.index');
    }

    public function json() {
        return DataTables::of(Layanan::where('type', 'publik'))
            ->addColumn('edit_url', function($row) {
                return url('dashboard/layanan-publik/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/layanan-publik/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.layanan.publik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $publik = new Layanan();
        $publik->type = $request->type;
        $publik->body = $request->body;
        $publik->save();

        return redirect('/dashboard/layanan-publik')->with('success', 'Layanan Publik berhasil ditambahkan');
    }

    public function edit($id)
    {
        $publik = Layanan::find($id);
        $data['publik'] = $publik;
        return view('admin.layanan.publik.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $publik = Layanan::find($id);
        $publik->type = $request->type;
        $publik->body = $request->body;
        $publik->save();
        return redirect('/dashboard/layanan-publik')->with('success', 'Layanan Publik berhasil diubah');
    }

    public function destroy($id)
    {
        $publik = Layanan::find($id);
        $publik->delete();
        return redirect('/dashboard/layanan-publik')->with('success', 'Data berhasil dihapus');
    }
}
