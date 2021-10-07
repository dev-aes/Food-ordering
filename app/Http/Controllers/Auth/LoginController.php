<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
 
    use AuthenticatesUsers;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // redirect to desired page by specific role allowed by GATE
        $credentials = $request->only('email', 'password');
     
        if(Auth::attempt($credentials)) {

            $request->session()->regenerate();
            return $user->hasRole('admin') 
            ? redirect(route('admin.dashboard.index'))
            : redirect(route('user.dashboard.index'));
             
        }
      
    }
}
