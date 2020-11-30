<?php

namespace App\Http\Controllers\Api\auth;
use App\models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'phone' => 'required|min:11|numeric',
        'password' => 'required|min:6'
      ]);
      
      // Attempt to log the user in
      $user = User::where('phone', $request->phone)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
              $user->api_token = Str::random(80);

              $user->save();
              return response()->json([
                    'api_token' => $user->api_token,
                    'user' => $user,
                ]);

               
            } else {
              return response()->json('بيانات الدخول غير صحيحه');
            }
          }
        }

    public function logout(Request $request)
    {
      $user = User::find($request->user()->id);
      $user->api_token = null;

        $user->save();
        return response()->json( 'logout success');
    }


    
}