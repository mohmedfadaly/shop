<?php


namespace App\Http\Controllers\Api\auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Resources\userResource;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' =>  'required|max:200',
            'phone' => 'required|string',
            'email' => ['required', 'max:250', 'unique:users,email'],
            'password' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
          ]);

        $user = new User() ;


        if(!is_null($request->image))
        {
            $originalImage= $request->file('image');
            $ext = $originalImage->getClientOriginalExtension();
            $thumbnailImage = Image::make($originalImage);
            $image ='cover_image' . '_' . time().  '.' . $ext;
            $originalImage->move(public_path('uploads/user') , $image);
            $thumbnailImage->resize(150,150);

            $user->image=$image;
        }

       
        $user->name =  $request->name ;
        $user->phone =  $request->phone ;
        $user->email =  $request->email ;
        $user->fcm_token =  null ;
        $user->address =  $request->address ;
        $user->latitude = null;
        $user->longitude = null;
        $user->password =  Hash::make ($request->password) ;
        $user->api_token = Str::random(80);

        $user->save();
        $user = User::where('phone', $request->phone)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
              return response()->json([
                    'api_token' => $user->api_token,
                    'user' => $user,
                ]);

            } else {
              return response()->json('بيانات الدخول غير صحيحه');
            }

          }
    
}

}
