<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Auth;

class PrvLoginController extends Controller
{
    public function __construct()
    {
            $this->middleware('guest:prov')->except('logout');
    }

   
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'phone' => 'required|min:11|numeric',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      if (Auth::guard('prov')->attempt(['phone' => $request->phone, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('start'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('phone', 'remember'));
    }

    public function showLoginForm (){
      return view('auth.prov-login');
    }

}
