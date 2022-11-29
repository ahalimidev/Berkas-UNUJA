<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UploadController extends Controller
{
    public function index(Request $req)
    {
        $all = DB::select("SELECT berkas.*,master_lembaga.*, master_fakultas.*, master_prodi.*,kategori_berkas.*, sub_berkas.* FROM berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas
        LEFT JOIN sub_berkas on sub_berkas.id_sub_berkas = berkas.id_sub_berkas
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi");
        if ($req->ajax()) {
            return DataTables::of($all)
            ->addIndexColumn()
            ->addColumn('action', function ($model) {
                return $model->id_berkas.'#_#'.$model->berkas;

            })
            ->make(true);
        }
        return view('upload.index');
    }

    public function create()
    {
        return view('upload.create');
    }

    public function store(Request $request)
    {
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
        $one = DB::selectOne("SELECT berkas.*,master_lembaga.*, master_fakultas.*, master_prodi.*,kategori_berkas.*, sub_berkas.* FROM berkas
        LEFT JOIN kategori_berkas on kategori_berkas.id_kategori_berkas = berkas.id_kategori_berkas
        LEFT JOIN sub_berkas on sub_berkas.id_sub_berkas = berkas.id_sub_berkas
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi
        where  berkas.id_berkas = '$id' ");
        return view('upload.show',compact('one'));

    }
    public function edit($id)
    {
        $one = berkas::where('id_berkas',$id)->first();
        return view('upload.edit',compact('one','id'));
    }

    public function update(Request $request, $id)
    {
        $one = berkas::where('id_berkas',$id)->first();
        if($request->hasFile('foto')){
            if($one->berkas != null){
                if($request->berkas != $one->berkas){
                    $fotoxx = public_path("../berkas/"). $one->berkas;
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
            berkas::where('id_berkas',$id)->update($save);
        }else{
            $save['id_kategori_berkas'] = $request->id_kategori_berkas;
            $save['id_sub_berkas'] = $request->id_sub_berkas;
            $save['id_lembaga'] = $request->id_lembaga == null ? null : $request->id_lembaga;
            $save['id_fakultas'] = $request->id_fakultas == null ? null : $request->id_fakultas;
            $save['id_prodi'] = $request->id_prodi == null ? null : $request->id_prodi;
            $save['nama_berkas'] = $request->nama_berkas;
            $save['keterangan_berkas'] = $request->keterangan_berkas;
            $save['status_berkas'] = $request->status_berkas;
            $save['total_revisi'] = $one->total_revisi + 1;
            berkas::where('id_berkas',$id)->update($save);

        }
        return redirect()->route('upload.index');
    }
    public function destroy($id)
    {
        $x=berkas::where('id_berkas',$id)->first();
        return $x->delete();
    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function download (Request $req){
        $id_kategori_berkas = $req->query('id_kategori_berkas');
        $id_sub_berkas = $req->query('id_sub_berkas');
        $pilih_kategori = $req->query('pilih_kategori');
        $id_lembaga = $req->query('id_lembaga');
        $id_fakultas = $req->query('id_fakultas');
        $id_prodi = $req->query('id_prodi');

        $kategori_berkas = $id_kategori_berkas == null ? "" : " AND berkas.id_kategori_berkas = '$id_kategori_berkas' ";
        $sub_berkas = $id_sub_berkas == null ? "" : " AND berkas.id_sub_berkas = '$id_sub_berkas' ";
        if ($pilih_kategori == null || $pilih_kategori == "" || $pilih_kategori == 0) {
            $lembaga = "";
            $fakultas = "";
            $prodi = "";
        } else if ($pilih_kategori == 1) {
            $lembaga = $id_kategori_berkas == null ? "" : " AND berkas.id_lembaga = '$id_lembaga' ";
            $fakultas = "";
            $prodi = "";
        } else if ($pilih_kategori == 2) {
            $fakultas = $id_fakultas == null ? "" : " AND berkas.id_fakultas = '$id_fakultas' ";
            $prodi = $id_prodi == null ? "" : " AND berkas.id_prodi = '$id_prodi' ";
            $lembaga = "";
        } else {
            $lembaga = "";
            $fakultas = "";
            $prodi = "";
        }

        $all = DB::select("SELECT berkas.nama_berkas,berkas.berkas,berkas.keterangan_berkas,berkas.status_berkas,master_lembaga.nama_lembaga, master_fakultas.nama_fakultas, master_prodi.program_studi FROM berkas
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
        LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi where berkas.berkas is not null $kategori_berkas $sub_berkas $lembaga $fakultas $prodi");
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->editColumn('nama_berkas', function ($model) {
                    return $model->nama_berkas . '#_#' . $model->berkas.'#_#'.$model->keterangan_berkas;
                })
                ->addColumn('lembaga', function ($model) {
                    return $model->nama_lembaga . '#_#' . $model->nama_fakultas . '#_#' . $model->program_studi;
                })
                ->addColumn('action', function ($model) {
                    return $model->berkas;
                })
                ->make(true);
        }
        return view('upload.download');
    }
    public function file($data)
    {
        $path = public_path("../berkas/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }


}
