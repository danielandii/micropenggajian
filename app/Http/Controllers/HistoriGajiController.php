<?php

namespace App\Http\Controllers;

use App\Models\histori_gaji;
use Illuminate\Http\Request;
use Validator;

class HistoriGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $histori = histori_gaji :: all();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $histori
            ]);

        //
        // $histori_gaji = histori_gaji :: all ();

        // if ($histori_gaji->count()>0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditemukan',
        //         'data'      => $histori_gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $histori_gaji
        //     ];
        // }

        // return response()->json($result); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = [
            'user_id' => 'required | numeric',
            'tanggal' => 'required | date_format:d/m/Y',
            'gaji_pokok' => 'required | numeric',
            'tunjangan' => 'required | numeric',
            'potongan' => 'required | numeric',
            'rekening' => 'required | unique:gajis'
             
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
            'date_format'       => 'd/m/Y',
            'numeric'           => 'Harus dalam angka'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }
        $histori           = new histori_gaji;
        $histori->user_id = $request->user_id;
        $histori->tanggal = $request->tanggal;
        $histori->gaji_pokok = $request->gaji_pokok;
        $histori->tunjangan = $request->tunjangan;
        $histori->potongan = $request->potongan;
        $histori->rekening = $request->rekening;
        $histori->save();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $histori
            ]);
        //
        // $this-> validate($request,[
        //     'tanggal'       => 'required',
        //     'gaji_pokok'    => 'required',
        //     'tunjangan'     => 'required',
        //     'potongan'      => 'required',
        //     'rekening'      => 'required'
        // ]);

        // $histori_gaji = histori_gaji :: create($request -> all());

        // if ($histori_gaji->count()>0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $histori_gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $histori_gaji
        //     ];
        // }

        // return response()->json($result);

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\histori_gaji  $histori_gaji
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $histori =  histori_gaji::find($id);
        //$data = Users::where('id',$id)->get();
        
        if (!$histori) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                "data" => ''
            ];
        } else {
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $histori
            ];
        }

        return response()->json($result);
        //
        // $histori_gaji = histori_gaji::where('idhistori_gaji',$id)->get();
        // if ($histori_gaji->count() >0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditemukan',
        //         'data'      => $histori_gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $histori_gaji
        // ];
        // }
        // return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\histori_gaji  $histori_gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(histori_gaji $histori_gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\histori_gaji  $histori_gaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        //
        $histori =  histori_gaji::find($id);
        //$department->nama = $request->nama;
        //$department->save();

        if (!$histori) {
            return response()->json([
                'code' => 404,
                'message' => 'id not found',
                'data' => '']);
        }
        $rules = [
            'user_id' => 'required | numeric',
            'tanggal' => 'required | date_format:d/m/Y',
            'gaji_pokok' => 'required | numeric',
            'tunjangan' => 'required | numeric',
            'potongan' => 'required | numeric',
            'rekening' => 'required | unique:gajis'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
            'date_format'       => 'd/m/Y',
            'numeric'           => 'Harus dalam angka'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }
        $histori->update([
        $histori->user_id = $request->user_id,
        $histori->tanggal = $request->tanggal,
        $histori->gaji_pokok = $request->gaji_pokok,
        $histori->tunjangan = $request->tunjangan,
        $histori->potongan = $request->potongan,
        $histori->rekening = $request->rekening,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $histori
            ]);

        // $histori_gaji=histori_gaji::where('idhistori_gaji',$id)->update($request->all());
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $histori
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\histori_gaji  $histori_gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $histori =  histori_gaji::find($id);
 
        if (!$histori) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $histori->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
        //
        // histori_gaji::where('idhistori_gaji',$id)->delete();
        // return response()->json('Data Sudah Di Hapus');
    }
}
