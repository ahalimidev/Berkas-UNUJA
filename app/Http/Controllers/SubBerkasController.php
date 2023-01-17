<?php

namespace App\Http\Controllers;

use App\Models\SubBerkas;
use App\Models\ViewBerkas;
use App\Models\ViewSubBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubBerkasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $id_unit = Auth::guard("web")->user()->id_unit;
        $all = ViewSubBerkas::where('id_unit', $id_unit)->get();
        if ($req->ajax()) {
            return DataTables::of($all)
                ->addIndexColumn()
                ->addColumn('cek', function ($model) {
                    return  $model->id_sub_berkas;
                })
                ->addColumn('action', function ($model) {
                    return  $model->id_sub_berkas;
                })
                ->make(true);
        }
        return view('sub_berkas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $berkas = ViewBerkas::where("status", "active")->get();
        return view('sub_berkas.create', compact('berkas'));
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
            'sub_berkas' => 'mimes:pdf,docx,doc,zip',
        ],[
            'mimes' => 'File Harus pdf, docx, doc atau zip'
        ]);
        if ($validator->fails()) {
            return Redirect()->route('sub_berkas.create')
                ->withErrors($validator)
                ->withInput();
        }
        $nama = Auth::guard("web")->user()->nama;
        $id_unit = Auth::guard("web")->user()->id_unit;
        $extension = $request->file('sub_berkas')->getClientOriginalExtension();
        $fileName = $this->quickRandom(26) . '.' . $extension;
        $request->file('sub_berkas')->move('document', $fileName);
        $save['sub_berkas'] = $fileName;
        $save['id_unit'] = $id_unit;
        $save["create_by"] =  $nama;
        $save["create_date"] = date('Y-m-d H:i:s');
        SubBerkas::create($save);
        return Redirect()->route('sub_berkas.index');
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
        $one = ViewSubBerkas::where('id_unit', $id_unit)->where('id_sub_berkas', $id)->first();
        return view('sub_berkas.show', compact('one'));
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
        $one = ViewSubBerkas::where('id_unit', $id_unit)->where('id_sub_berkas', $id)->first();
        $berkas = ViewBerkas::where("status", "active")->get();
        return view('sub_berkas.edit', compact('one', 'berkas','id'));
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
            'sub_berkas' => 'mimes:pdf,docx,doc,zip',
        ],[
            'mimes' => 'File Harus pdf, docx, doc atau zip'
        ]);

        if ($validator->fails()) {
            return Redirect()->route('sub_berkas.edit',$id)
                ->withErrors($validator)
                ->withInput();
        }
        $nama = Auth::guard("web")->user()->nama;
        $id_unit = Auth::guard("web")->user()->id_unit;
        $one = SubBerkas::where('id_sub_berkas', $id)->select('sub_berkas')->first();
        if ($request->hasFile('sub_berkas')) {
            if ($one->sub_berkas != null) {
                if ($request->sub_berkas != $one->sub_berkas) {
                    $berkasxx = public_path("../document/") . $one->sub_berkas;
                    if (file_exists($berkasxx)) {
                        unlink($berkasxx);
                    }
                }
            }

            $extension = $request->file('sub_berkas')->getClientOriginalExtension();
            $fileName = $this->quickRandom(26) . '.' . $extension;
            $request->file('sub_berkas')->move('document', $fileName);
            $save['sub_berkas'] = $fileName;
        } else {
            $save['sub_berkas'] = $one->sub_berkas;
        }
        $save['id_unit'] = $id_unit;
        $save["update_by"] =  $nama;
        $save["update_date"] = date('Y-m-d H:i:s');
        unset($save['_token']);
        unset($save['_method']);
        SubBerkas::where('id_sub_berkas', $id)->update($save);
        return Redirect()->route('sub_berkas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $x = SubBerkas::where('id_sub_berkas', $id)->first();
        $berkasxx = public_path("../document/") . $x->sub_berkas;
        if (file_exists($berkasxx)) {
            unlink($berkasxx);
        }
        $x->delete();
        return response()->json(['status' => 'success']);
    }

    public function edit_multi(Request $request)
    {

        foreach ($request->id_sub_berkas as $row) {

            $save["update_by"] =  Auth::guard("web")->user()->nama;
            $save["update_date"] = date('Y-m-d H:i:s');
            $save['status'] = $request->status;
            SubBerkas::updateOrCreate(["id_sub_berkas" => $row], $save);
        }
        return response()->json(['status' => 'success']);
    }

    public function berkas($id_berkas)
    {
        return ViewBerkas::where('id_berkas',$id_berkas)->first();
    }


    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
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
