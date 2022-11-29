<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function lembaga(){
        return DB::table('master_lembaga')->get();
    }

    public function fakultas(){
        return DB::table('master_fakultas')->get();
    }

    public function prodi($id){
        return DB::table('master_prodi')->where('id_fakultas',$id)->get();
    }


    public function kategori(){
        return DB::table('kategori_berkas')->get();
    }

    public function sub_kategori($id){
        return DB::table('sub_berkas')->where('id_kategori_berkas',$id)->get();
    }

    public function lembaga_berkas_atas(){
        return DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.id_berkas) AS TOTAL FROM master_lembaga
        LEFT JOIN berkas ON berkas.id_lembaga = master_lembaga.id_lembaga
        GROUP BY master_lembaga.id_lembaga
        ORDER BY COUNT(berkas.id_berkas) DESC");
    }

    public function lembaga_berkas_bawah(){
        return DB::select("SELECT master_lembaga.nama_lembaga, COUNT(berkas.id_berkas) AS TOTAL FROM master_lembaga
        LEFT JOIN berkas ON berkas.id_lembaga = master_lembaga.id_lembaga
        GROUP BY master_lembaga.id_lembaga
        ORDER BY COUNT(berkas.id_berkas) ASC");
    }

    public function berkas_fakultas(){
        return DB::select("SELECT master_fakultas.nama_fakultas, COUNT(berkas.id_berkas) AS TOTAL
        FROM master_fakultas
        LEFT JOIN berkas ON master_fakultas.id_fakultas = berkas.id_fakultas
        GROUP BY master_fakultas.id_fakultas");
    }
}
