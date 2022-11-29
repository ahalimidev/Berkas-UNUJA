<?php

namespace App\Http\Controllers;

use App\Models\berkas;
use App\Models\kategori_berkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function master_lembaga(Request $req){
        $all = DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_lembaga
        LEFT JOIN berkas on master_lembaga.id_lembaga = berkas.id_lembaga
        GROUP BY master_lembaga.id_lembaga");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }

    public function master_lembaga_tahun(Request $req,$tahun){
        $all = DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_lembaga
        LEFT JOIN berkas on master_lembaga.id_lembaga = berkas.id_lembaga and year(berkas.create_date) = '$tahun'
        GROUP BY master_lembaga.id_lembaga");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }


    public function master_fakultas(Request $req){
        $all = DB::select("SELECT master_fakultas.nama_fakultas, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_fakultas
        LEFT JOIN berkas on master_fakultas.id_fakultas = berkas.id_fakultas
        GROUP BY master_fakultas.id_fakultas");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }

    public function master_fakultas_tahun(Request $req,$tahun){
        $all = DB::select("SELECT master_fakultas.nama_fakultas, COUNT(berkas.total_download) as download, count(berkas.id_berkas) as berkas FROM master_fakultas
        LEFT JOIN berkas on master_fakultas.id_fakultas = berkas.id_fakultas and year(berkas.create_date) = '$tahun'
        GROUP BY master_fakultas.id_fakultas");
        if ($req->ajax()) {
            return DataTables::of($all)->make(true);
        }
    }
}
