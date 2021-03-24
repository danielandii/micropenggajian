<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = user :: all ();
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
        $this -> validate($request,[
             'username' => 'required|unique:users',
             'password' => 'required',
             'nama'     => 'required',
             'email'    => 'required',
             'alamat'   => 'required',
             'phone'    => 'required|numeric'
        ]);
        $user = user :: create($request -> all());
        return response()->json($user);

        if ($user){
            $result = [
                'status'    => 200,
                'pesan'     => 'Data Sudah Ditambahkan',
                'data'      => $data
            ];
        } else {
            $result = [
                'status'    => 400,
                'pesan'     => 'Data Tidak Bisa Ditambahkan',
                'data'      => ''
            ];
        }
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
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = user::where('iduser',$id)->get();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        user::where('iduser',$id)->update($request->all());
        return response()->json("Data Sudah Di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        user::where('iduser',$id)->delete();
        return response()->json('Data Sudah Di Hapus');

    }
}
