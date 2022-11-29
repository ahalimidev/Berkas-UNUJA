<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BerkasController extends Controller
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

        $x = Auth::user('web')->id_lembaga;
        $y = Auth::user('web')->id_fakultas;
        $id_lembaga = Auth::user('web')->id_lembaga == null ? '' :  "where berkas.id_lembaga = '$x' ";
        $id_fakultas = Auth::user('web')->id_fakultas == null ? '' :  "where berkas.id_fakultas = '$y' ";

        $all = DB::select("SELECT berkas.*,
        master_lembaga.id_lembaga, master_lembaga.nama_lembaga,
        master_fakultas.id_fakultas, master_fakultas.nama_fakultas,
        master_prodi.prodi_id,master_prodi.program_studi,
        kategori_berkas.id_kategori_berkas,kategori_berkas.nama_kategori_berkas,
        sub_berkas.id_sub_berkas,sub_berkas.nama_sub_berkas FROM berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas
        LEFT JOIN sub_berkas on sub_berkas.id_sub_berkas = berkas.id_sub_berkas
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi
        $id_fakultas $id_lembaga");
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_berkas . '#_#' . $model->berkas;
                })
                ->make(true);
        }
        return view('berkas.index');
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

        $id_fakultas = Auth::user('web')->id_fakultas;

        return view('berkas.create',compact('id_fakultas'));
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

        $x = Auth::user('web')->id_lembaga;
        $y = Auth::user('web')->id_fakultas;
        $nama = Auth::user('web')->nama;
        $extension = $request->file('berkas')->getClientOriginalExtension();
        $fileName = $this->quickRandom(26) . '.' . $extension;
        $request->file('berkas')->move('berkas', $fileName);
        $save['id_kategori_berkas'] = $request->id_kategori_berkas;
        $save['id_sub_berkas'] = $request->id_sub_berkas;
        $save['id_lembaga'] = Auth::user('web')->id_lembaga == null ? null : Auth::user('web')->id_lembaga;
        $save['id_fakultas'] = Auth::user('web')->id_fakultas == null ? null : Auth::user('web')->id_fakultas;
        $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
        $save['nama_berkas'] = $request->nama_berkas;
        $save['keterangan_berkas'] = $request->keterangan_berkas;
        $save['status_berkas'] = $request->status_berkas;
        $save['berkas'] = $fileName;
        if($x != null){
            $one = DB::table('master_lembaga')->where('id_lembaga',$x)->first();
            $save['create_date'] = date('Y-m-d H:i:s');
            $save['create_by'] = $nama.'-'.$one->nama_lembaga;
        }
        if($y != null){
            $one = DB::table('master_fakultas')->where('id_fakultas',$y)->first();
            $save['create_date'] = date('Y-m-d H:i:s');
            $save['create_by'] = $nama.'-'.$one->nama_fakultas;
        }
        berkas::create($save);
        return redirect()->route('upload_berkas.index');
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

        $one = DB::selectOne("SELECT berkas.*,
        master_lembaga.id_lembaga, master_lembaga.nama_lembaga,
        master_fakultas.id_fakultas, master_fakultas.nama_fakultas,
        master_prodi.prodi_id,master_prodi.program_studi,
        kategori_berkas.id_kategori_berkas,kategori_berkas.nama_kategori_berkas,
        sub_berkas.id_sub_berkas,sub_berkas.nama_sub_berkas
        FROM berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas
        LEFT JOIN sub_berkas on sub_berkas.id_sub_berkas = berkas.id_sub_berkas
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi
        where  berkas.id_berkas = '$id' ");
        return view('berkas.show', compact('one'));
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

        $id_fakultas = Auth::user('web')->id_fakultas;

        $one = berkas::where('id_berkas', $id)->first();
        return view('berkas.edit', compact('one', 'id','id_fakultas'));
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

        $x = Auth::user('web')->id_lembaga;
        $y = Auth::user('web')->id_fakultas;
        $nama = Auth::user('web')->nama;
        $one = berkas::where('id_berkas', $id)->first();
        if ($request->hasFile('foto')) {
            if ($one->berkas != null) {
                if ($request->berkas != $one->berkas) {
                    $fotoxx = public_path("../berkas/") . $one->berkas;
                    if (file_exists($fotoxx)) {
                        unlink($fotoxx);
                    }
                }
            }
            $extension = $request->file('berkas')->getClientOriginalExtension();
            $fileName = $this->quickRandom(26) . '.' . $extension;
            $request->file('berkas')->move('berkas', $fileName);
            $save['id_kategori_berkas'] = $request->id_kategori_berkas;
            $save['id_sub_berkas'] = $request->id_sub_berkas;
            $save['id_lembaga'] = Auth::user('web')->id_lembaga == null ? null : Auth::user('web')->id_lembaga;
            $save['id_fakultas'] = Auth::user('web')->id_fakultas == null ? null : Auth::user('web')->id_fakultas;
            $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
            $save['nama_berkas'] = $request->nama_berkas;
            $save['keterangan_berkas'] = $request->keterangan_berkas;
            $save['status_berkas'] = $request->status_berkas;
            $save['berkas'] = $fileName;
            $save['total_revisi'] = $one->total_revisi + 1;
            if($x != null){
                $one = DB::table('master_lembaga')->where('id_lembaga',$x)->first();
                $save['update_date'] = date('Y-m-d H:i:s');
                $save['update_by'] = $one->nama_lembaga;
            }
            if($y != null){
                $one = DB::table('master_fakultas')->where('id_fakultas',$y)->first();
                $save['update_date'] = date('Y-m-d H:i:s');
                $save['update_by'] = $one->nama_fakultas;
            }
            berkas::where('id_berkas', $id)->update($save);
        } else {
            $save['id_kategori_berkas'] = $request->id_kategori_berkas;
            $save['id_sub_berkas'] = $request->id_sub_berkas;
            $save['id_lembaga'] = Auth::user('web')->id_lembaga == null ? null : Auth::user('web')->id_lembaga;
            $save['id_fakultas'] = Auth::user('web')->id_fakultas == null ? null : Auth::user('web')->id_fakultas;
            $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
            $save['nama_berkas'] = $request->nama_berkas;
            $save['keterangan_berkas'] = $request->keterangan_berkas;
            $save['status_berkas'] = $request->status_berkas;
            $save['total_revisi'] = $one->total_revisi + 1;

            if($x != null){
                $one = DB::table('master_lembaga')->where('id_lembaga',$x)->first();
                $save['update_date'] = date('Y-m-d H:i:s');
                $save['update_by'] = $nama.'-'.$one->nama_lembaga;
            }
            if($y != null){
                $one = DB::table('master_fakultas')->where('id_fakultas',$y)->first();
                $save['update_date'] = date('Y-m-d H:i:s');
                $save['update_by'] = $nama.'-'.$one->nama_fakultas;
            }
            berkas::where('id_berkas', $id)->update($save);
        }
        return redirect()->route('upload_berkas.index');
    }
    public function destroy($id)
    {
         if(Auth::guard('web')->check()){
            if(Auth::user('web')->status == "viewer"){
                return redirect()->route('dashboard.index');
            }
       }else{
         return redirect()->route('dashboard.index');
       }

        $x = berkas::where('id_berkas', $id)->first();
        return $x->delete();
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
