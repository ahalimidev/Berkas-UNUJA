<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\JenisBerkas;
use App\Models\SubBerkas;
use App\Models\ViewBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $id_unit = Auth::guard("web")->user()->id_unit;
        $all = ViewBerkas::where('id_unit', $id_unit)->get();
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('cek', function ($model) {
                    return  $model->id_berkas;
                })
                ->editColumn('status_spmi', function ($model) {
                    return  $model->status_spmi == 'n' ? 'Tidak' : 'Ya';
                })
                ->addColumn('action', function ($model) {
                    return  $model->id_berkas;
                })
                ->make(true);
        }
        return view('berkas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('berkas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $save = $request->all();
        $validator = Validator::make($save, [
            'berkas' => 'mimes:pdf,docx,doc,zip',
        ],[
            'mimes' => 'File harus pdf, docx, doc atau zip'
        ]);
        if ($validator->fails()) {
            return Redirect()->route('berkas.create')
                ->withErrors($validator)
                ->withInput();
        }
        $nama = Auth::guard("web")->user()->nama;
        $id_unit = Auth::guard("web")->user()->id_unit;
        $extension = $request->file('berkas')->getClientOriginalExtension();
        $fileName = $this->quickRandom(26) . '.' . $extension;
        $request->file('berkas')->move('document', $fileName);
        $save['berkas'] = $fileName;
        $save['id_unit'] = $id_unit;
        $save["create_by"] =  $nama;
        $save["create_date"] = date('Y-m-d H:i:s');
        Berkas::create($save);
        return Redirect()->route('berkas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_unit = Auth::guard("web")->user()->id_unit;
        $one = ViewBerkas::where('id_unit', $id_unit)->where('id_berkas', $id)->first();
        return view('berkas.show', compact('one'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id_unit = Auth::guard("web")->user()->id_unit;
        $one = ViewBerkas::where('id_unit', $id_unit)->where('id_berkas', $id)->first();

        return view('berkas.edit', compact('one', 'id'));
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
        $save = $request->all();
        $validator = Validator::make($save, [
            'berkas' => 'mimes:pdf,docx,doc,zip',
        ],[
            'mimes' => 'File harus pdf, docx, doc atau zip'
        ]);
        if ($validator->fails()) {
            return Redirect()->route('berkas.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
        $nama = Auth::guard("web")->user()->nama;
        $id_unit = Auth::guard("web")->user()->id_unit;
        $one = berkas::where('id_berkas', $id)->select('berkas')->first();
        if ($request->hasFile('berkas')) {
            if ($one->berkas != null) {
                if ($request->berkas != $one->berkas) {
                    $berkasxx = public_path("../document/") . $one->berkas;
                    if (file_exists($berkasxx)) {
                        unlink($berkasxx);
                    }
                }
            }

            $extension = $request->file('berkas')->getClientOriginalExtension();
            $fileName = $this->quickRandom(26) . '.' . $extension;
            $request->file('berkas')->move('document', $fileName);
            $save['berkas'] = $fileName;
        } else {
            $save['berkas'] = $one->berkas;
        }
        $save['id_unit'] = $id_unit;
        $save["update_by"] =  $nama;
        $save["update_date"] = date('Y-m-d H:i:s');
        unset($save['_token']);
        unset($save['_method']);
        berkas::where('id_berkas', $id)->update($save);
        return Redirect()->route('berkas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $x = berkas::where('id_berkas', $id)->first();
        $berkasxx = public_path("../document/") . $x->berkas;
        if (file_exists($berkasxx)) {
            unlink($berkasxx);
        }
        $x->delete();
        return response()->json(['status' => 'success']);
    }

    public function edit_multi(Request $request)
    {

        foreach ($request->id_berkas as $row) {

            $save["update_by"] =  Auth::guard("web")->user()->nama;
            $save["update_date"] = date('Y-m-d H:i:s');
            $save['status'] = $request->status;
            Berkas::updateOrCreate(["id_berkas" => $row], $save);
        }
        return response()->json(['status' => 'success']);
    }
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function jenis_berkas($status){
        $jenis_berkas = JenisBerkas::where("status", "active")->where("status_spmi", $status)->get();
        return $jenis_berkas;
    }
    public function show_pdf($data)
    {
       $path = public_path("../document/") . $data;
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
