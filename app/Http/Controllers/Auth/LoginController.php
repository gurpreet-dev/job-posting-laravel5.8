<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => isset($request->role) ? $request->role : 'applicant', 'status' => 1])) {
            if(isset($_GET['redirectto'])){
                return redirect()->away($_GET['redirectto']);
            }else{
                return redirect($this->redirectPath());
            }
        }else{
            return $this->sendFailedLoginResponse($request);
        }
    }
}
