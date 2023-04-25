<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiLoginController extends Controller
{
    // function login
    // public function login(Request $request)
    // {
    //     $name = $request->name;
    //     $password = $request->password;

    //     $query = User::where('name', $name)
    //         ->where('password', $password)
    //         ->first();

    //     if ($query) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Login Berhasil',
    //             'code' => '200',
    //             'data' => $query,
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Login Gagal',
    //             'code' => '404',
    //         ]);
    //     }
    // }

    public function login(Request $request)
    {
        $login = Auth::Attempt($request->all());
        if ($login) {
            $user = Auth::user();
            $user->save();
            // $user->makeVisible('api_token');

            return response()->json([
                'status'  => true,
                'message' => 'Login Berhasil',
                'code'    => '200',
                'data'    => $user
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'code'    => '404',
                'message' => 'Username atau Password Tidak Ditemukan!'
            ]);
        }
    }
}
