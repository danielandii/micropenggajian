<?php

namespace App\Http\Controllers;

use App\Models\histori_gaji;
use Illuminate\Http\Request;

class HistoriGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = histori_gaji :: all ();
        return response()->json($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        histori_gaji :: create($request -> all());
        return response()->json('Data Sudah Di Masukan');

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
        //
        $data = histori_gaji::where('idhistori_gaji',$id)->get();
        return response()->json($data);
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
        histori_gaji::where('idhistori_gaji',$id)->update($request->all());
        return response()->json("Data Sudah Di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\histori_gaji  $histori_gaji
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        histori_gaji::where('idhistori_gaji',$id)->delete();
        return response()->json('Data Sudah Di Hapus');
    }
}
