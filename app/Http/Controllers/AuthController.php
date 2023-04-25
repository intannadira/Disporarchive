<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;


class AuthController extends Controller
{

    public function userProfile() {

        $user = User::with('Role')->where('id', Auth::user()->id)->first();

        return response()->json([
            'status'  => 'success',
            'id'      => Auth::user()->id,
            'id_user' => Auth::user()->id_user,
            'name'    => Auth::user()->name,
            'role'    => $user['role']->name
        ], 200);

    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return redirect('http://127.0.0.1:8000/login');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

}