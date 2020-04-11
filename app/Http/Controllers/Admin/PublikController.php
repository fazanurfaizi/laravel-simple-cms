<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Layanan;
use DataTables;

class PublikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layanan.publik.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publik = new Layanan();
        $publik->type = $request->type;
        $publik->body = $request->body;
        $publik->save();

        return redirect('/dashboard/layanan-publik')->with('success', 'Layanan Publik berhasil ditambahkan');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publik = Layanan::find($id);
        $data['publik'] = $publik;
        return view('admin.layanan.publik.edit', $data);
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
        $publik = Layanan::find($id);
        $publik->type = $request->type;
        $publik->body = $request->body;
        $publik->save();
        return redirect('/dashboard/layanan-publik')->with('success', 'Layanan Publik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publik = Layanan::find($id);
        $publik->delete();
        return redirect('/dashboard/layanan-publik')->with('success', 'Data berhasil dihapus');
    }
}
