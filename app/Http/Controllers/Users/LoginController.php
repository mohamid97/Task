<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * login return login view
     */

        public function __construct()
    {
        $this->middleware('guest');
    }


    public function login()
    {
        return view('users.auth.login');
    }

    /**
     * check login with ajax
     */
    public function check_login(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|min:3|max:100',
            'password' => 'required|min:6|max:15'
        ]);
        if (\Auth::attempt($request->only(["username", "password"]))) {
            if(Auth::user()->is_admin == '1'){
                return response()->json(['/dashboard']);
            }else{
                return response()->json(['/home']);
            }

        }else{
            return response()->json(['credentials'=>"Invalid credentials"], 422);

        }

    }
}
