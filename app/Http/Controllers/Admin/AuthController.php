<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function username(){
        return 'email';
    }

    public function showlogin(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
    
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'admin'])) {
            return redirect()->intended(route('admin.dashboard'));
        }else{
            return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->intended(route('admin.login'));
    }
}
