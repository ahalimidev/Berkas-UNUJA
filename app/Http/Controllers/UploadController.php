<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UploadController extends Controller
{
    public function index(Request $req)
    {

        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('dashboard.index');
        }

        $all = DB::select("SELECT berkas.*,
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
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi");
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return $model->id_berkas . '#_#' . $model->berkas;
                })
                ->make(true);
        }
        return view('upload.index');
    }

    public function create()
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('dashboard.index');
        }

        return view('upload.create');
    }

    public function store(Request $request)
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('dashboard.index');
        }

        $extension = $request->file('berkas')->getClientOriginalExtension();
        $fileName = $this->quickRandom(26) . '.' . $extension;
        $request->file('berkas')->move('berkas', $fileName);
        $save['id_kategori_berkas'] = $request->id_kategori_berkas;
        $save['id_sub_berkas'] = $request->id_sub_berkas;
        $save['id_lembaga'] = $request->id_lembaga == null ? null : $request->id_lembaga;
        $save['id_fakultas'] = $request->id_fakultas == null ? null : $request->id_fakultas;
        $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
        $save['nama_berkas'] = $request->nama_berkas;
        $save['keterangan_berkas'] = $request->keterangan_berkas;
        $save['status_berkas'] = $request->status_berkas;
        $save['berkas'] = $fileName;
        berkas::create($save);
        return redirect()->route('upload.index');
    }

    public function show($id)
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
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
        return view('upload.show', compact('one'));
    }
    public function edit($id)
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('dashboard.index');
        }

        $one = berkas::where('id_berkas', $id)->first();
        return view('upload.edit', compact('one', 'id'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
            return redirect()->route('dashboard.index');
        }

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
            $save['id_lembaga'] = $request->id_lembaga == null ? null : $request->id_lembaga;
            $save['id_fakultas'] = $request->id_fakultas == null ? null : $request->id_fakultas;
            $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
            $save['nama_berkas'] = $request->nama_berkas;
            $save['keterangan_berkas'] = $request->keterangan_berkas;
            $save['status_berkas'] = $request->status_berkas;
            $save['berkas'] = $fileName;
            $save['total_revisi'] = $one->total_revisi + 1;
            berkas::where('id_berkas', $id)->update($save);
        } else {
            $save['id_kategori_berkas'] = $request->id_kategori_berkas;
            $save['id_sub_berkas'] = $request->id_sub_berkas;
            $save['id_lembaga'] = $request->id_lembaga == null ? null : $request->id_lembaga;
            $save['id_fakultas'] = $request->id_fakultas == null ? null : $request->id_fakultas;
            $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
            $save['nama_berkas'] = $request->nama_berkas;
            $save['keterangan_berkas'] = $request->keterangan_berkas;
            $save['status_berkas'] = $request->status_berkas;
            $save['total_revisi'] = $one->total_revisi + 1;
            berkas::where('id_berkas', $id)->update($save);
        }
        return redirect()->route('upload.index');
    }
    public function destroy($id)
    {
        if (Auth::guard('web')->check()) {
            if (Auth::user('web')->status == "viewer") {
                return redirect()->route('dashboard.index');
            }
        } else {
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
