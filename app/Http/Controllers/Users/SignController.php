<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * return to regsiter view
     */
    public function index(){
        return view('users.auth.register');
    }
    public function register(AdminUserRequest $request){
        User::create([
            'username'=>$request->username,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        return redirect()->route('login')->with('success','User Added Successfully!');
    }
}
