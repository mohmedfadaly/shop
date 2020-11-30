<?php

namespace App\Http\Controllers\backend;

use App\models\Prov;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\models\Img;
use App\models\Section;
use App\models\City;
use Intervention\Image\Facades\Image;
use File;

class providers extends backendController
{

    
    public function __construct(Prov $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $providers = Prov::paginate(10);
        return view('back_end.providers.index',compact('providers'));
    }

    public function create() {
        $sections = Section::get();
        $cities = City::get();
        return view('back_end.providers.create', compact('sections','cities'));

    }

    public function store(Request $request) {

        $request->validate([
            'name' =>  'required|max:191',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|max:500',
            'password' => 'required|max:500',
            'city_id' => ['required'],
            'sec_id' => ['required'],
            'image_i' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
           
        ]);

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
        $Prov->city_id =  $request->city_id ;
        $Prov->sec_id =  $request->sec_id ;
        $Prov->address =  $request->address ;
        $Prov->latitude =  $request->latitude ;
        $Prov->longitude =  $request->longitude ;
        $Prov->image_i =  $image_i ;
        $Prov->reats =  $request->reats ;
        $Prov->wallet =  $request->wallet ;
        $Prov->password =  Hash::make ($request->password);
        
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

        return redirect()->route('providers.index')->with('status', 'التخصص انشأ');
    }

    public function edit($id) {
        $Prov = Prov::find($id);
        $sections = Section::get();
        $cities = City::get();
        return view('back_end.providers.edit', compact('Prov','sections','cities'));


    }

    public function update(Request $request, $id) {

        $request->validate([
            'name' =>  'required|max:191',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|max:500',
            'password' => 'required|max:500',
            'city_id' => ['required'],
            'sec_id' => ['required'],
            'image_i' => 'image|mimes:jpeg,png,jpg,gif|',
            'address'=> 'required|string|max:500',
           
        ]);
      
        $Prov = Prov::find($id) ;
        if(!is_null($request->image_i))
        {
        File::delete('uploads/ii/'.$Prov->image_i);
        $originalImage= $request->file('image_i');
        $ext = $originalImage->getClientOriginalExtension();
        $thumbnailImage = Image::make($originalImage);
        $image_i ='i_image' . '_' . time().  '.' . $ext;
        $originalImage->move(public_path('uploads/ii') , $image_i);
        $thumbnailImage->resize(150,150);
        $Prov->image_i =  $image_i ;
        }

      
        $Prov->name =  $request->name ;
        $Prov->phone =  $request->phone ;
        $Prov->email =  $request->email ;
        $Prov->city_id =  $request->city_id ;
        $Prov->sec_id =  $request->sec_id ;
        $Prov->address =  $request->address ;
        $Prov->latitude = $request->latitude;
        $Prov->longitude = $request->longitude;
        $Prov->reats =  $request->reats ;
        $Prov->wallet =  $request->wallet ;
      
        $Prov->password =  Hash::make ($request->password);
        $Prov->update();
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
            $img->images   = $name;
            $img->save();
        }
    }
        return redirect()->route('providers.index')->with('status', 'التخصص تم التعديل !');
    }

    public function destroy($id) {
        $Prov = Prov::find($id) ;
        $Prov->delete();
        return redirect()->route('providers.index')->with('status', 'النخصص مسح !');
    }
}
