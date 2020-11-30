<?php

namespace App\Http\Controllers\backend;

use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use DB;
use File;
class users extends backendController
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
    //
    public function index() {

        $users = User::paginate(30);
        return view('back_end.users.index',compact('users'));
    }
   
    public function create() {
        return view('back_end.users.create');

    }

    public function store(Request $request){
        $request->validate([
            'name' =>  'required|max:200',
            'phone' => 'required|string',
            'email' => 'required|max:500',
            'password' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
            
        ]);

        $user = new User() ;


        if(!is_null($request->image))
        {
            $originalImage= $request->file('image');
            $ext = $originalImage->getClientOriginalExtension();
            $image ='cover_image' . '_' . time().  '.' . $ext;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailImage->save(public_path('uploads/user/'. $image)); 
            $thumbnailImage->resize(150,150);

            $user->image=$image;
        }

       
        $user->name =  $request->name ;
        $user->phone =  $request->phone ;
        $user->email =  $request->email ;
        $user->address =  $request->address ;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->password =  Hash::make ($request->password) ;
        $user->save();
        

        
        return redirect()->route('users.index')->with('status', 'user was created !');
    }






    public function edit($id) {
        $user = User::find($id);
        return view('back_end.users.edit', compact('user'));


    }

    public function update(Request $request, $id) {




        $request->validate([
            'name' =>  'required|max:200',
            'phone' => 'required|string',
            'email' => 'required|max:500',
            'password' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
            

        ]);

        $user = User::find($id) ;

     
        if(!is_null($request->image))
        {
            File::delete('uploads/user/'.$user->image);
          $originalImage= $request->file('image');
            $ext = $originalImage->getClientOriginalExtension();
            $image ='cover_image' . '_' . time().  '.' . $ext;
            $thumbnailImage = Image::make($originalImage);
            $thumbnailImage->save(public_path('uploads/user/'. $image)); 
            $thumbnailImage->resize(150,150);


            $user->image=$image;
        }

        



 
       
        $user->name =  $request->name ;
        $user->phone =  $request->phone ;
        $user->email =  $request->email ;
        $user->address =  $request->address ;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->password =  Hash::make ($request->password) ;
        $user->state =  $request->state ;
        $user->save();

        

        
        return redirect()->route('users.index')->with('status', 'user was updated !');
    }

    public function destroy($id) {
        $user = User::find($id) ;
        $user->delete();
        return redirect()->route('users.index')->with('status', 'user was deleted !');
    }
}
