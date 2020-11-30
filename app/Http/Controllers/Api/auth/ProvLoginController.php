<?php

namespace App\Http\Controllers\Api\auth;
use App\models\Prov;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Resources\userResource;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class ProvLoginController  extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:prov-api');
    }

    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'phone' => 'required|min:11|numeric',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      $Prov = Prov::where('phone', $request->phone)->first();
      if ($Prov) {
          if (Hash::check($request->password, $Prov->password)) {
            $Prov->api_token = Str::random(80);

            $Prov->save();
            return response()->json([
                  'api_token' => $Prov->api_token,
                  'Prov' => $Prov,
              ]);

          } else {
            return response()->json('بيانات الدخول غير صحيحه');
          }
        }
    
}
}