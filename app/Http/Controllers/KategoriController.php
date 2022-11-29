<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use App\Models\kategori_berkas;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index(Request $req)
    {
        $all = kategori_berkas::all();
        if ($req->ajax()) {
            return DataTables::of($all)
            ->addIndexColumn()
            ->addColumn('action', function ($model) {
                return $model->id_kategori_berkas;

            })
            ->make(true);
        }
        return view('kategori.index');
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $save = $request->all();
        unset($save['_token']);
        kategori_berkas::updateOrCreate($save, $save);
        return redirect()->route('kategori.index');
    }

    public function show($id)
    {
        $one = kategori_berkas::where('id_kategori_berkas',$id)->first();
        return view('kategori.show',compact('one'));

    }
    public function edit($id)
    {
        $one = kategori_berkas::where('id_kategori_berkas',$id)->first();
        return view('kategori.edit',compact('one','id'));
    }

    public function update(Request $request, $id)
    {
        $save = $request->all();
        unset($save['_token']);
        kategori_berkas::updateOrCreate(['id_kategori_berkas' => $id], $save);
        return redirect()->route('kategori.index');
    }
    public function destroy($id)
    {

    }

}
