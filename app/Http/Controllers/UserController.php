<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ViewUnit;
use App\Models\ViewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $all = ViewUser::all();
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('cek', function ($model) {
                    return  $model->id_user;
                })
                ->addColumn('action', function ($model) {
                    return  $model->id_user;
                })
                ->make(true);
        }
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $v_unit = ViewUnit::where("status","active")->get();
        return view('user.create',compact('v_unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $x = User::where('username',$request->username)->first();
        if($x != null){
            return Redirect()->route('user.create')->withInput()->with('error', 'Esername '.$request->username.' sudah ada');
        }
        $save = $request->all();
        $save["create_by"] =  Auth::guard("web")->user()->nama;
        $save["create_date"] = date('Y-m-d H:i:s');
        $save["password"] = bcrypt($request->password);

        User::create($save);
        return Redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $one = ViewUser::where('id_user',$id)->first();
        return view('user.show',compact('one'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $v_unit = ViewUnit::where("status","active")->get();
        $one = ViewUser::where('id_user',$id)->first();
        return view('user.edit',compact('v_unit','one','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $y = User::where('id_user',$id)->first();
        $x = User::where('username',$request->username)->first();
        if($x != null){
            if($x->username != $y->username){
                return Redirect()->route('user.edit',['user' => $id])->withInput()->with('error', 'Username '.$request->username.' sudah ada');
            }
        }
        if($request->password != ""){
            User::find($id)->update([
                'id_unit' => $request->id_unit,
                'nama' => $request->nama,
                'username' => $request->username,
                'update_by' => Auth::guard("web")->user()->nama,
                'update_date' => date('Y-m-d H:i:s'),
                'password' =>  bcrypt($request->password),
                'status' =>  $request->status,
            ]);
        }else{
            User::find($id)->update([
                'id_unit' => $request->id_unit,
                'nama' => $request->nama,
                'username' => $request->username,
                'update_by' => Auth::guard("web")->user()->nama,
                'update_date' => date('Y-m-d H:i:s'),
                'status' =>  $request->status,
            ]);
        }
        return Redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $x = User::where('id_user', $id)->first();
        return $x->delete();
    }

    public function edit_multi(Request $request)
    {

        foreach ($request->id_user as $row) {
            $save["update_by"] =  Auth::guard("web")->user()->nama;
            $save["update_date"] = date('Y-m-d H:i:s');
            $save['status'] = $request->status;
            User::updateOrCreate(["id_user" => $row], $save);
        }
        return response()->json(['status' => 'success']);
    }

    public function form_login (){
        return view('user.login');
    }

    public function akses_login (Request $request){
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
}
