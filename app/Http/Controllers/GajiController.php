<?php

namespace App\Http\Controllers;

use App\Models\gaji;
use App\Models\user;
use Illuminate\Http\Request;
use Validator;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $gaji = gaji :: all();

        $gaji = gaji::with(['user' => function($q) {
            $q->select('id', 'nama');
        }])->get(['id', 'user_id', 'gaji_pokok', 'tunjangan', 'potongan', 'rekening']);

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $gaji
            ]);

        // if ($gaji->count()>0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $gaji
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
            'gaji_pokok' => 'required | numeric',
            'tunjangan' => 'required | numeric',
            'potongan' => 'required | numeric',
            'rekening' => 'required | unique:gajis',
            'user_id' => 'required | numeric'
             
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
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
        $gaji           = new gaji;
        $gaji->gaji_pokok = $request->gaji_pokok;
        $gaji->tunjangan = $request->tunjangan;
        $gaji->potongan = $request->potongan;
        $gaji->rekening = $request->rekening;
        $gaji->user_id = $request->user_id;
        $gaji->save();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $gaji
            ]);
        //
        // $gaji = gaji :: create($request->all());

        // if ($gaji->count()>0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $gaji
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
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $gaji = gajis::where('id',$id)->get();
        $gaji =  gaji::find($id);

        if (!$gaji) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                'data' => ''
            ];
        } else {
            $gaji->get();
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $gaji
            ];
        }

        return response()->json($result);
        // if ($gaji->count()>0){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $gaji
        //     ];
        // }

        // return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function edit(gaji $gaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $gaji =  gaji::find($id);

        if (!$gaji) {
            return response()->json([
                'code' => 404,
                'message' => 'id not found',
                'data' => '']);
        }

        $rules = [
            'gaji_pokok' => 'required | numeric',
            'tunjangan' => 'required | numeric',
            'potongan' => 'required | numeric',
            'rekening' => 'required ',
            'user_id' => 'required | numeric'

             
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
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

        $gaji->update([
        $gaji->gaji_pokok = $request->gaji_pokok,
        $gaji->tunjangan = $request->tunjangan,
        $gaji->potongan = $request->potongan,
        $gaji->rekening = $request->rekening,
        $gaji->user_id = $request->user_id,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $gaji
            ]);
        //
        // gaji::where('id',$id)->update($request->all());

        // if (!$gaji){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $gaji
        //     ];
        // } else { 
        //     $result= [
        //         'status'    => 404,
        //         'pesan'     => 'not found',
        //         'data'      => $gaji
        //     ];
        // }

        // return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gaji  $gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gaji =  gaji::find($id);
 
        if (!$gaji) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $gaji->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
        //
        // gaji::where('id',$id)->delete();
        // return response()->json('Data Sudah Di Hapus');
    }
}
