<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function login_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $login = User::where('username', $username)->first();
        if ($login != null) {
            if (Hash::check($password, $login->password)) {
                if (Auth::guard('web')->attempt(['username' => $username, 'password' => $password])) {
                    return redirect()->intended(url("/"));
                }
            } else {
                return Redirect()->route('auth.login')->withInput()->with('error', 'Username dan Password salah');
            }
        } else {
            return Redirect()->route('auth.login')->withInput()->with('error', 'Username dan Password salah');
        }
    }
    public function logout()
    {
        Auth::guard("web")->logout();
        session()->flush();
        return redirect()->route('dashboard.index');
    }

    public function master_lembaga(Request $req)
    {
        $all = DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_lembaga
        LEFT JOIN berkas on master_lembaga.id_lembaga = berkas.id_lembaga
        GROUP BY master_lembaga.id_lembaga");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }

    public function master_lembaga_tahun(Request $req, $tahun)
    {
        $all = DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_lembaga
        LEFT JOIN berkas on master_lembaga.id_lembaga = berkas.id_lembaga and year(berkas.create_date) = '$tahun'
        GROUP BY master_lembaga.id_lembaga");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }


    public function master_fakultas(Request $req)
    {
        $all = DB::select("SELECT master_fakultas.nama_fakultas, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_fakultas
        LEFT JOIN berkas on master_fakultas.id_fakultas = berkas.id_fakultas
        GROUP BY master_fakultas.id_fakultas");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }

    public function master_fakultas_tahun(Request $req, $tahun)
    {
        $all = DB::select("SELECT master_fakultas.nama_fakultas, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_fakultas
        LEFT JOIN berkas on master_fakultas.id_fakultas = berkas.id_fakultas and year(berkas.create_date) = '$tahun'
        GROUP BY master_fakultas.id_fakultas");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }

    public function download(Request $req)
    {
        $pencarian = $req->query('q');
        $id_kategori_berkas = $req->query('id_kategori_berkas');
        $id_sub_berkas = $req->query('id_sub_berkas');
        $pilih_kategori = $req->query('pilih_kategori');
        $id_lembaga = $req->query('id_lembaga');
        $id_fakultas = $req->query('id_fakultas');
        $id_prodi = $req->query('id_prodi');
        $login = Auth::guard('web')->check();

        $kategori_berkas = $id_kategori_berkas == null ? "" : " AND berkas.id_kategori_berkas = '$id_kategori_berkas' ";
        $sub_berkas = $id_sub_berkas == null ? "" : " AND berkas.id_sub_berkas = '$id_sub_berkas' ";
        if ($pilih_kategori == null || $pilih_kategori == "" || $pilih_kategori == 0) {
            $lembaga = "";
            $fakultas = "";
            $prodi = "";
        } else if ($pilih_kategori == 1) {
            $lembaga = $id_kategori_berkas == null ? "AND berkas.id_fakultas IS NOT NULL " : " AND berkas.id_lembaga = '$id_lembaga' ";
            $fakultas = "";
            $prodi = "";
        } else if ($pilih_kategori == 2) {
            $fakultas = $id_fakultas == null ? "AND berkas.id_fakultas IS NOT NULL " : " AND berkas.id_fakultas = '$id_fakultas' ";
            $prodi = $id_prodi == null ? "" : " AND berkas.id_prodi = '$id_prodi' ";
            $lembaga = "";
        } else {
            $lembaga = "";
            $fakultas = "";
            $prodi = "";
        }
        if ($pencarian == 'pencarian') {
            $all = DB::select("SELECT berkas.nama_berkas,berkas.berkas,berkas.keterangan_berkas,berkas.status_berkas,master_lembaga.nama_lembaga, master_fakultas.nama_fakultas, master_prodi.program_studi FROM berkas
            LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
            LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
            LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi where berkas.berkas is not null $kategori_berkas $sub_berkas $lembaga $fakultas $prodi");
            if ($req->ajax()) {
                return DataTables::of($all)
                    ->addIndexColumn()
                    ->editColumn('nama_berkas', function ($model) {
                        return $model->nama_berkas . '#_#' . $model->berkas . '#_#' . $model->keterangan_berkas . '#_#' . $model->status_berkas;
                    })
                    ->addColumn('lembaga', function ($model) {
                        return $model->nama_lembaga . '#_#' . $model->nama_fakultas . '#_#' . $model->program_studi;
                    })
                    ->addColumn('action', function ($model) {
                        return $model->berkas . '#_#' . $model->status_berkas;
                    })
                    ->make(true);
            }
        }else{
            $all = DB::select("SELECT berkas.nama_berkas,berkas.berkas,berkas.keterangan_berkas,berkas.status_berkas,master_lembaga.nama_lembaga, master_fakultas.nama_fakultas, master_prodi.program_studi FROM berkas
            LEFT JOIN master_lembaga on master_lembaga.id_lembaga = berkas.id_lembaga
            LEFT JOIN master_fakultas on master_fakultas.id_fakultas = berkas.id_fakultas
            LEFT JOIN master_prodi on master_prodi.prodi_id = berkas.id_prodi where berkas.berkas is not null and berkas.status_berkas = 'y' ");
            if ($req->ajax()) {
                return DataTables::of($all)
                    ->addIndexColumn()
                    ->editColumn('nama_berkas', function ($model) {
                        return $model->nama_berkas . '#_#' . $model->berkas . '#_#' . $model->keterangan_berkas . '#_#' . $model->status_berkas;
                    })
                    ->addColumn('lembaga', function ($model) {
                        return $model->nama_lembaga . '#_#' . $model->nama_fakultas . '#_#' . $model->program_studi;
                    })
                    ->addColumn('action', function ($model) {
                        return $model->berkas . '#_#' . $model->status_berkas;
                    })
                    ->make(true);
            }
        }

        return view('upload.download', compact('login'));
    }
    public function file($data)
    {

        $x = DB::table('berkas')->select('nama_berkas')->where('berkas',$data)->first();

        $path = public_path("../berkas/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $extension = File::extension($path);

        return response()->download($path,$x->nama_berkas.'.'.$extension);


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

    public function show_pdf($data)
    {
       $path = public_path("../berkas/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);
    }
}
