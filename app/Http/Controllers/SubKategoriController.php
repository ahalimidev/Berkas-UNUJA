<?php

namespace App\Http\Controllers;

use App\Models\kategori_berkas;
use App\Models\sub_berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SubKategoriController extends Controller
{
    public function index(Request $req)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }

        $all = DB::select("SELECT kategori_berkas.nama_kategori_berkas,sub_berkas.*
        FROM sub_berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = sub_berkas.id_kategori_berkas");
        if ($req->ajax()) {
            return DataTables::of($all)
            ->addIndexColumn()
            ->addColumn('action', function ($model) {
                return $model->id_sub_berkas;

            })
            ->make(true);
        }
        return view('sub_kategori.index');
    }

    public function create()
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }
        $kategori_berkas = kategori_berkas::all();
        return view('sub_kategori.create',compact('kategori_berkas'));
    }

    public function store(Request $request)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }
        $save = $request->all();
        unset($save['_token']);
        sub_berkas::updateOrCreate($save, $save);
        return redirect()->route('sub_kategori.index');
    }

    public function show($id)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }

        $one = DB::selectOne("SELECT kategori_berkas.nama_kategori_berkas,sub_berkas.*
        FROM sub_berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = sub_berkas.id_kategori_berkas
        where sub_berkas.id_sub_berkas = '$id' ");
        return view('sub_kategori.show',compact('one'));

    }
    public function edit($id)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }

        $kategori_berkas = kategori_berkas::all();
        $one = sub_berkas::where('id_sub_berkas',$id)->first();
        return view('sub_kategori.edit',compact('one','id','kategori_berkas'));
    }

    public function update(Request $request, $id)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }

        $save = $request->all();
        unset($save['_token']);
        sub_berkas::updateOrCreate(['id_sub_berkas' => $id], $save);
        return redirect()->route('sub_kategori.index');
    }
    public function destroy($id)
    {

    }

}
