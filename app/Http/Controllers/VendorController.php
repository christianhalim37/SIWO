<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Datatables::of(Vendors::all())
                ->setRowId(function(Vendors $vendors){
                    return $vendors->id_vendor;
                })->addColumn('aksi','admin.vendors.action-button')
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "id_vendor"=> "required|numeric|exists:vendors,id_vendor"
        ]);
        $response = ['ok'=>true];
        if($validator->fails()){
            $response['ok'] = false;
            $response['msg'] = "Id tidak valid";
        }else{
            Mahasiswa::find($request->input('id_vendor'))->delete();
            $response['msg'] = "berhasil menghapus data";
        }
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = Validator::make($request->all(),[
            "id_vendor"=> "required|numeric|exists:vendor,id_vendor"
        ]);
        $response = ['ok'=>true];
        if($validator->fails()){
            $response['ok'] = false;
            $response['msg'] = "Id tidak valid";
        }else{
            Vendor::find($request->input('id_vendor'))->delete();
            $response['msg'] = "berhasil menghapus data";
        }
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        # code...
        $res = ['stored'=>true];
        $validator = Validator::make($request->all(),[
            "nama_vendor" => "required|min:3",
            'alamat' => 'required',
            'no_telp' => 'required|min:10',
            'deskripsi' => 'required',
            'email' => 'required|email',
            'contact_person' => 'required',
            'kat_vendor_id' => 'required|numeric'
        ]);
        if($validator->fails()){
            $res['msg'] = Alert::errorList($validator->errors());
            $res['stored'] = false;
        }else{
            $vendors = new Vendors();
            $vendors->nama_vendor = $request->input("nama_vendor");
            $vendors->alamat = $request->input('alamat');
            $vendors->no_telp = $request->input('no_telp');
            $vendors->deskripsi = $request->input('deskripsi');
            $vendors->email = $request->input('email');
            $vendors->contact_person = $request->input('contact_person');
            $vendors->kat_vendor_id = $request->input('kat_vendor_id');
            $vendors->save();
            $res['msg'] = Alert::success("Berhasil Menambahkan Data");
        }

        return response()->json($res, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        # code...
        $validator = Validator::make($request->all(),[
            "nama_vendor" => "required|min:3",
            'alamat' => 'required',
            'no_telp' => 'required|min:10',
            'deskripsi' => 'required',
            'email' => 'required|email',
            'contact_person' => 'required',
            'kat_vendor_id' => 'required|numeric'
        ]);

        $response = ["stored"=>true];
        
        if($validator->fails()){
            $response['stored'] = false;
            $response['msg']    = Alert::errorList($validator->errors());
        }else{
            $vendors = Vendors::find($request->input('id_vendor'));
            if($vendors){

                
                $vendors->nama_vendor = $request->input("nama_vendor");
                $vendors->alamat = $request->input('alamat');
                $vendors->no_telp = $request->input('no_telp');
                $vendors->deskripsi = $request->input('deskripsi');
                $vendors->email = $request->input('email');
                $vendors->contact_person = $request->input('contact_person');
                $vendors->save();
                $vendors->kat_vendor_id()->sync($request->input('kat_vendor_id'));
                $response['msg'] = Alert::success("Berhasil Memperbarui Data Portofolio");
            }else{
                $response['stored'] = false;
                $response['msg']    = Alert::errorList("Data tidak ditemukan");
            }
        }
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
