<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class HukumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layanan.hukum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hukum = new Layanan();
        $hukum->type = $request->type;
        $hukum->body = $request->body;
        $hukum->save();

        return redirect('/dashboard/layanan-hukum')->with('success', 'Layanan Hukum berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hukum = Layanan::find($id);
        $data['hukum'] = $hukum;
        return view('admin.layanan.hukum.edit', $data);
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
        $hukum = Layanan::find($id);
        $hukum->type = $request->type;
        $hukum->body = $request->body;
        $hukum->save();
        return redirect('/dashboard/layanan-hukum')->with('success', 'Layanan Hukum berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hukum = Layanan::find($id);
        $hukum->delete();
        return redirect('/dashboard/layanan-hukum')->with('success', 'Data berhasil dihapus');
    }
}
