<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class InformationController extends Controller
{

    public function index()
    {
        return view('admin.layanan.informasi.index');
    }

    public function json() {
        return DataTables::of(Layanan::where('type', 'info'))
            ->addColumn('edit_url', function($row) {
                return url('dashboard/information/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/information/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.layanan.informasi.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $info = new Layanan();
        $info->type = $request->type;
        $info->body = $request->body;
        $info->save();

        return redirect('/dashboard/information')->with('success', 'Informasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $info = Layanan::find($id);
        $data['info'] = $info;
        return view('admin.layanan.info.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $info = Layanan::find($id);
        $info->type = $request->type;
        $info->body = $request->body;
        $info->save();
        return redirect('/dashboard/information')->with('success', 'Informasi berhasil diubah');
    }

    public function destroy($id)
    {
        $info = Layanan::find($id);
        $info->delete();
        return redirect('/dashboard/information')->with('success', 'Informasi berhasil dihapus');
    }
}
