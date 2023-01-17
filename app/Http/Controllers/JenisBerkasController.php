<?php

namespace App\Http\Controllers;

use App\Models\JenisBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class JenisBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $all = JenisBerkas::orderBy('id_jenis_berkas', 'desc')->get();
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('cek', function ($model) {
                    return  $model->id_jenis_berkas;
                })
                ->editColumn('status_spmi', function ($model) {
                    return  $model->status_spmi == 'n' ? 'Tidak' : 'Ya';
                })
                ->addColumn('action', function ($model) {
                    return  $model->id_jenis_berkas;
                })
                ->make(true);
        }
        return view('jenis_berkas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis_berkas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $x = JenisBerkas::where('nama_jenis_berkas', $request->nama_jenis_berkas)->first();
        if ($x != null) {
            return Redirect()->route('jenis_berkas.create')->withInput()->with('error', 'Jenis Berkas Is Already Taken');
        }

        $validator = Validator::make($request->all(), [
            'nama_jenis_berkas' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect()->route('jenis_berkas.create')
                ->withErrors($validator)
                ->withInput();
        }

        $save = $request->all();
        $save["nama_jenis_berkas"] = $request->nama_jenis_berkas;
        $save["create_by"] =  Auth::guard("web")->user()->nama;
        $save["create_date"] = date('Y-m-d H:i:s');
        JenisBerkas::create($save);
        return Redirect()->route('jenis_berkas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $one = JenisBerkas::where('id_jenis_berkas', $id)->first();
        return view('jenis_berkas.show', compact('one'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $one = JenisBerkas::where('id_jenis_berkas', $id)->first();
        return view('jenis_berkas.edit', compact('id', 'one'));
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
        $one = JenisBerkas::where('id_jenis_berkas', $id)->first();

        $x = JenisBerkas::where('nama_jenis_berkas', $request->nama_jenis_berkas)->first();
        if ($x != null) {
            if ($one->nama_jenis_berkas != $x->nama_jenis_berkas) {
                return Redirect()->route('jenis_berkas.edit', $id)->withInput()->with('error', 'Jenis Berkas Is Already Taken');
            }
        }

        $validator = Validator::make($request->all(), [
            'nama_jenis_berkas' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect()->route('jenis_berkas.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        $save = $request->all();
        $save["nama_jenis_berkas"] = $request->nama_jenis_berkas;
        $save["update_by"] =  Auth::guard("web")->user()->nama;
        $save["update_date"] = date('Y-m-d H:i:s');
        JenisBerkas::updateOrCreate(["id_jenis_berkas" => $id], $save);

        return Redirect()->route('jenis_berkas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return JenisBerkas::where('id_jenis_berkas', $id)->delete();
    }

    public function edit_multi(Request $request)
    {

        foreach ($request->id_jenis_berkas as $row) {
            $save["update_by"] =  Auth::guard("web")->user()->nama;
            $save["update_date"] = date('Y-m-d H:i:s');
            $save['status'] = $request->status;
            JenisBerkas::updateOrCreate(["id_jenis_berkas" => $row], $save);
        }
        return response()->json(['status' => 'success']);
    }
}
