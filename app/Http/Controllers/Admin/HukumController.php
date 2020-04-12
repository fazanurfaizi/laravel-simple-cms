<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class HukumController extends Controller
{

    public function index()
    {
        return view('admin.layanan.hukum.index');
    }

    public function json() {
        return DataTables::of(Layanan::where('type', 'hukum'))
            ->addColumn('edit_url', function($row) {
                return url('dashboard/layanan-hukum/edit/' . $row->id);
            })
            ->addColumn('delete_url', function($row) {
                return url('dashboard/layanan-hukum/delete/' . $row->id);
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.layanan.hukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $hukum = new Layanan();
        $hukum->type = $request->type;
        $hukum->body = $request->body;
        $hukum->save();

        return redirect('/dashboard/layanan-hukum')->with('success', 'Layanan Hukum berhasil ditambahkan');
    }

    public function edit($id)
    {
        $hukum = Layanan::find($id);
        $data['hukum'] = $hukum;
        return view('admin.layanan.hukum.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'body' => 'required|string'
        ]);

        $hukum = Layanan::find($id);
        $hukum->type = $request->type;
        $hukum->body = $request->body;
        $hukum->save();
        return redirect('/dashboard/layanan-hukum')->with('success', 'Layanan Hukum berhasil diubah');
    }

    public function destroy($id)
    {
        $hukum = Layanan::find($id);
        $hukum->delete();
        return redirect('/dashboard/layanan-hukum')->with('success', 'Data berhasil dihapus');
    }
}
