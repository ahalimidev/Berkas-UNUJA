<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AuthController extends Controller
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
        $all = DB::select("SELECT user.id_user, user.nama, user.username, user.status, master_lembaga.nama_lembaga, master_fakultas.nama_fakultas FROM user
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = user.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = user.id_fakultas");
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('lembaga', function ($model) {
                    return $model->nama_lembaga . '#_#' . $model->nama_fakultas;
                })
                ->addColumn('action', function ($model) {
                    return $model->id_user;
                })
                ->make(true);
        }
        return view('auth.index');
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
        return view('auth.create');
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
        $x = User::where('username',$request->username)->first();
        if($x != null){
            return Redirect()->route('auth.create')->withInput()->with('error', 'Esername '.$request->username.' sudah ada');
        }
        $save = $request->all();
        $save["password"] = bcrypt($request->password);

        User::create($save);
        return Redirect()->route('auth.index');
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
        $one = DB::selectOne("SELECT user.*, master_lembaga.nama_lembaga, master_fakultas.nama_fakultas FROM user
        LEFT JOIN master_lembaga on master_lembaga.id_lembaga = user.id_lembaga
        LEFT JOIN master_fakultas on master_fakultas.id_fakultas = user.id_fakultas
        where user.id_user = '$id' ");
        return view('auth.show',compact('one'));
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
        $one = User::where('id_user', $id)->first();
        return view('auth.edit',compact('one','id'));
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
        $y = User::where('id_user',$id)->first();
        $x = User::where('username',$request->username)->first();
        if($x->username != $y->username){
            return Redirect()->route('user.edit',['user' => $id])->withInput()->with('error', 'Username '.$request->username.' sudah ada');
        }
        if($request->password != ""){
            User::find($id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'status' => $request->status,
                'id_lembaga' => $request->id_lembaga,
                'id_fakultas' => $request->id_fakultas,
                'password' =>  bcrypt($request->password)
            ]);
        }else{
            User::find($id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'status' => $request->status,
                'id_lembaga' => $request->id_lembaga,
                'id_fakultas' => $request->id_fakultas,
            ]);
        }
        return Redirect()->route('auth.index');

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
        $x = User::where('id_user', $id)->first();
        return $x->delete();
    }
}
