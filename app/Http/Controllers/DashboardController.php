<?php

namespace App\Http\Controllers;

use App\Models\JenisBerkas;
use App\Models\ViewBerkas;
use App\Models\ViewSubBerkas;
use App\Models\ViewUnit;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        $pencarian = $req->query('q');
        $jenis_berkas = $req->query('jenis_berkas');
        $tanggal_awal =  $req->query('tanggal_awal');
        $tanggal_akhir =  $req->query('tanggal_akhir');
        $unit = $req->query('unit');
        $status_berkas = $req->query('status_berkas');
        $status_spmi = $req->query('status_spmi');
        if ($pencarian == 'pencarian') {
            $jenis_berkas = $jenis_berkas == "" ? "" : " AND id_jenis_berkas = '$jenis_berkas' ";
            $status_berkas = $status_berkas == "" ? "" : " AND status_berkas = '$status_berkas' ";
            $status_spmi = $status_spmi == "" ? "" : " AND status_spmi = '$status_spmi' ";
            if ($tanggal_awal != "" && $tanggal_akhir != "") {
                $tanggal = " AND date(create_date) BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";
            } else {
                $tanggal = "";
            }
            $unit = $unit == "" ? "" : " AND id_unit = '$unit' ";
            $all = DB::select("SELECT * FROM v_berkas where status = 'active' $jenis_berkas $status_spmi $status_berkas $tanggal $unit");
            if ($req->ajax()) {
                return DataTables::of($all)
                    ->addIndexColumn()
                    ->addColumn('action', function ($model) {
                        return  Crypt::encrypt($model->id_berkas);
                    })
                    ->editColumn('nama_berkas', function ($model) {
                        return  $model->nama_berkas . '#_#' . Crypt::encrypt($model->id_berkas);
                    })
                    ->editColumn('create_date', function ($model) {
                        return  $model->create_date == null ?  "" : Carbon::parse($model->create_date)->format('d/m/Y H:i:s');
                    })
                    ->editColumn('update_date', function ($model) {
                        return  $model->update_date == null ?  "" : Carbon::parse($model->update_date)->format('d/m/Y H:i:s');
                    })
                    ->make(true);
            }
        } else {
            $all = ViewBerkas::where('status', 'active')->get();
            if ($req->ajax()) {
                return DataTables::of($all)
                    ->addIndexColumn()
                    ->addColumn('action', function ($model) {
                        return  Crypt::encrypt($model->id_berkas);
                    })
                    ->editColumn('nama_berkas', function ($model) {
                        return  $model->nama_berkas . '#_#' . Crypt::encrypt($model->id_berkas);
                    })
                    ->editColumn('create_date', function ($model) {
                        return  $model->create_date == null ?  "" : Carbon::parse($model->create_date)->format('d/m/Y H:i:s');
                    })
                    ->editColumn('update_date', function ($model) {
                        return  $model->update_date == null ?  "" : Carbon::parse($model->update_date)->format('d/m/Y H:i:s');
                    })
                    ->make(true);
            }
        }

        $unit = ViewUnit::select('id_unit', 'nama_unit')->where('status', 'active')->get();
        $jenis_berkas = JenisBerkas::select('id_jenis_berkas', 'nama_jenis_berkas')->where('status', 'active')->get();

        return view('download', compact('unit', 'jenis_berkas'));
    }

    public function show($id_berkas)
    {
        try {
            $decrypted = Crypt::decrypt($id_berkas);
            $one = ViewBerkas::where('id_berkas', $decrypted)->where('status', 'active')->first();
            $all = ViewSubBerkas::where('id_berkas', $decrypted)->where('status', 'active')->get();
            if ($one->status_berkas == 'n') {
                if (Auth::guard('web')->check()) {
                    return view('detail_download', compact('one', 'all'));
                } else {
                    return redirect()->route('auth.login');
                }
            } else {
                return view('detail_download', compact('one', 'all'));
            }
        } catch (DecryptException $e) {
            return view('errors.404');
        }
    }
    public function download_pdf($data)
    {

        $x = DB::table('berkas')->select('nama_berkas')->where('berkas', $data)->first();

        $path = public_path("../document/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $extension = File::extension($path);

        return response()->download($path, $x->nama_berkas . '.' . $extension);
    }
    public function sub_download_pdf($data)
    {

        $x = DB::table('sub_berkas')->select('nama_sub_berkas')->where('sub_berkas', $data)->first();

        $path = public_path("../document/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $extension = File::extension($path);

        return response()->download($path, $x->nama_sub_berkas . '.' . $extension);
    }

    public function show_pdf($data)
    {
        $path = public_path("../document/") . $data;
        if (!File::exists($path)) {
            abort(404);
        }
        $pdfContent = File::get($path);
        // for pdf, it will be 'application/pdf'
        $type       = File::mimeType($path);
        $fileName   = File::name($path);
        return Response::make($pdfContent, 200, [
            'Content-Type'        => $type,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }
}
