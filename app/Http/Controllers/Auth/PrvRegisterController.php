<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\models\Prov;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\Facades\Image;
use File;
use Auth;
use Illuminate\Support\Str;
use App\models\Img;
use App\models\Section;
use App\models\City;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PrvRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

     /**
         * Where to redirect users after registration.
         *
         * @var string
         */
        protected $redirectTo = '/start';

        /**
         * Create a new controller instance.
         *
         * @return void
         */
        // public function __construct()
        // {
        //     $this->middleware('guest');
        // }

          public function __construct()
        {
            $this->middleware('guest');
            $this->middleware('guest:prov');
        }

        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data)
        {
            return Validator::make($data, [
            'name' =>  'required|max:191',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|max:500',
            'password' => 'required|max:500',
            'city_id' => ['required'],
            'sec_id' => ['required'],
            'image_i' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
            ]);
        }

        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array  $data
         * @return \App\User
         */

       
        public function showProvRegisterForm()
        {
            return view('auth.prov-register');
        }

         protected function createProv(Request $request)
        {
            $originalImage= $request->file('image_i');
            $ext = $originalImage->getClientOriginalExtension();
            $thumbnailImage = Image::make($originalImage);
            $image_i ='i_image' . '_' . time().  '.' . $ext;
            $originalImage->move(public_path('uploads/ii') , $image_i);
            $thumbnailImage->resize(150,150);
    
    
            $Prov = new Prov() ;
            $Prov->name =  $request->name ;
            $Prov->phone =  $request->phone ;
            $Prov->email =  $request->email ;
            $Prov->fcm_token =  null ;
            $Prov->city_id =  $request->city_id ;
            $Prov->sec_id =  $request->sec_id ;
            $Prov->address =  $request->address ;
            $Prov->latitude =  $request->latitude ;
            $Prov->longitude =  $request->longitude ;
            $Prov->image_i =  $image_i ;
            $Prov->password =  Hash::make ($request->password);
            $Prov->api_token = Str::random(80);
            
            $Prov->save();
    
            
            if($request->hasfile('images'))
            {
            foreach($request->images as $image){
    
                $originalImage= $image;
                $ext = $originalImage->getClientOriginalExtension();
                $thumbnailImage = Image::make($originalImage);
                $name ='cover_image' . '_' . time().  '.' . $ext;
                $originalImage->move(public_path('uploads/images') , $name);
                $thumbnailImage->resize(150,150);
            
                $img = new Img;
                $img->pro_id = $Prov->id;
                $img->images = $name;
                $img->save();
            }
        }
    
        if (Auth::guard('prov')
        ->attempt(['phone' => $request->phone, 'password' => $request->password])) {

   return redirect('/start');
}
    }
}
