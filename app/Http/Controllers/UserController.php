<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\histori_gaji;
use App\Models\gaji;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user = user :: all();
        $user = user  ::with(['gaji' => function($q) {
            $q->select('id', 'gaji_pokok');
        }])->get(['id', 'username', 'alamat', 'email', 'phone', 'nama', 'gaji_id']);

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $user
            ]);
        //
        // $data = user :: all ();
        // return response()->json($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $rules = [
             'username' => 'required|unique:users',
             'password' => 'required | min:6',
             'nama'     => 'required',
             'email' => 'required|unique:users|email:rfc,dns',
             'alamat'   => 'required',
             'phone'    => 'required|unique:users|numeric',
             'gaji_id' => 'required | numeric'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
            'password.min'      => 'Password minimal diisi dengan 6 karakter.',
            'email.email'       => 'Email tidak valid.',           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }

        $users           = new User;
        $users->username = $request->username;
        $users->password = Hash::make($request->password);
        $users->nama = $request->nama;
        $users->alamat = $request->alamat;
        $users->email    = $request->email;
        $users->phone = $request->phone;
        $users->gaji_id = $request->gaji_id;
        $users->save();
       
        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $users
            ]);
        // $user = user :: create($request -> all());
        // return response()->json($user);

        // if ($user){
        //     $result = [
        //         'status'    => 200,
        //         'pesan'     => 'Data Sudah Ditambahkan',
        //         'data'      => $data
        //     ];
        // } else {
        //     $result = [
        //         'status'    => 400,
        //         'pesan'     => 'Data Tidak Bisa Ditambahkan',
        //         'data'      => ''
        //     ];
        // }
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
        $users =  User::find($id);
        
        if (!$users) {
            $result = [
                "code" => 404,
                "message" => "id not found",
                "data" => ''
            ];
        } else {
            $result = [
                "code" => 200,
                "message" => "success",
                "data" => $users
            ];
        }

        return response()->json($result);
        // //
        // $data = user::where('iduser',$id)->get();
        // return response()->json($data);
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
        $users =  User::find($id);
        //$department->nama = $request->nama;
        //$department->save();

        if (!$users) {
            return response()->json([
                'code' => 404,
                'message' => 'id not found',
                'data' => '']);
        }

        $rules = [
            'username' => 'required | unique:users',
            'password' => 'required | min:6',
            'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users|email:rfc,dns',
            'phone' => 'required|unique:users|numeric',
            'gaji_id' => 'required | numeric'
        ];

        $messages = [
            'required'          => 'wajib diisi.',
            'unique'            => 'sudah terdaftar.',
            'password.min'      => 'Password minimal diisi dengan 6 karakter.',
            'email.email'       => 'Email tidak valid.'           
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'data' => $validator->messages()
            ], 400);
        }

        $users->update([
            $users->username = $request->username,
            $users->password = Hash::make($request->password),
            $users->nama = $request->nama,
            $users->alamat = $request->alamat,
            $users->email    = $request->email,
            $users->gaji_id = $request->gaji_id,
            $users->phone = $request->phone,
        ]);

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $users
            ]);
        //
        // user::where('iduser',$id)->update($request->all());
        // return response()->json("Data Sudah Di update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $users =  User::find($id);
 
        if (!$users) {
            $data = [
                "code" => 404,
                "message" => "id not found"
            ];
        } else {
            $users->delete();
            $data = [
                "code" => 200,
                "message" => "success_deleted"
            ];
        }
 
        return response()->json($data);
        //
        // user::where('iduser',$id)->delete();
        // return response()->json('Data Sudah Di Hapus');

    }

    public function getUserHistoriGaji($id)
    {
        $data = histori_gaji::where('user_id', $id)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success',
            'data' => $data

            ]);
            
    }
}
