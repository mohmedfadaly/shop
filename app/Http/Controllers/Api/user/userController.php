<?php

namespace App\Http\Controllers\Api\user;
use App\models\Prov;
use App\models\User;
use App\models\Serv;
use App\models\Fav;
use App\models\Section;
use App\models\Req_serv;
use App\models\Req;
use App\models\Reat;
use App\models\Not;
use App\models\Ums;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use File;
class userController extends Controller
{
    

    public function home(Request $request)
    {

        $sections = Section::get();
        $user = $request->user()->id;
        return response()->json(compact('sections','user'));
    }


    public function section($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('id' , 'desc');
        if(request()->has('search') && request()->get('search') != ''){
            $providers = $providers->where('name' , 'like' , "%".request()->get('search')."%");
        }
        $providers = $providers->get();
        return response()->json($providers);
    }

    
    public function top($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('reats' , 'desc')->get();
        return response()->json($providers);
    }

    public function near(Request $request, $id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('id' , 'desc')->get();


        $latitude = $request->user()->latitude;
        $longitude = $request->user()->longitude;
        $radius = 10;

        $providers          =       DB::table("providers");

        $providers          =       $providers->where('sec_id' , $id)->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $providers          =       $providers->having('distance', '<', 20);
        $providers          =       $providers->orderBy('distance', 'asc');

        $providers          =       $providers->get();


        return response()->json($providers);
    }

    public function provider($id){
        $provider = Prov::findOrFail($id);
     
            return response()->json($provider);
       
        
    }

    public function reqcreate($id) {
        $provider = Prov::findOrFail($id);
        $Serv = Serv::where('prov_id' , $id)->get();
        return response()->json( compact('provider','Serv'));

    }

    public function reqstore(Request $request) {
        $request->validate([
            'state' =>  'required',
            'prov_id' =>  'required',
            'time_from' =>  'required',
            'time_to' =>  'required',
            'address' =>  'required',
            'date' =>  'required',
            'des' =>  'required',
            'name' =>  'required|max:191',
            'phone' => 'required|min:11|numeric',
        ]);
        $Req = new Req() ;
        $Req->name =  $request->name ;
        $Req->phone =  $request->phone ;
        $Req->state =  $request->state ;
        $Req->prov_id =  $request->prov_id ;
        $Req->active =  $request->active ;
        $Req->user_id = $request->user()->id ;
        $Req->time_from =  $request->time_from ;
        $Req->time_to =  $request->time_to ;
        $Req->address =  $request->address ;
        $Req->longitude =  null ;
        $Req->latitude =  null ;
        $Req->date =  $request->date ;
        $Req->des =  $request->des ;
        $Req->Total =  $request->Total ;
        $Req->tax =  $request->tax ;
        $Req->active =  $request->active ;
        
        $Req->why =  null ;
        $Req->save();
        $Req->Servs()->attach($request->serv);
        
       // dd($Req->id); 
        
       $id = $Req->id;
      // dd($id);

      $Not = new Not() ;
        $Not->users_id =  $request->user()->id ;
        $Not->pro_id =  $request->pro_id ;
        $Not->nots =  $request->nots . $request->user()->name;
        $Not->kind =  $request->kind ;
        $Not->save();

       
        return response()->json( compact('id','Not'));
    }
   
    public function cheak($id) {
        $Req = Req::findOrFail($id);
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();

        return response()->json( compact('Req','Servs','Serv'));

    }

    public function cheakupdate(Request $request, $id) {
        $Req = Req::findOrFail($id);
        $Req->Total =  $Req->Servs()->sum('salary') ;
        $Req->tax =  $Req->Servs()->sum('salary')* 0.05 ;
        $Req->save();
        return response()->json( compact('Req'));

    }

    public function new() {

        $Req = Req::where('state', '=', '0' )->orWhere('state', '=', '2')->orWhere('state', '=', '3')->orWhere('state', '=', '4')->get();
        return response()->json( compact('Req'));
    }

    public function old() {

        $Req = Req::where('state', '=', '5' )->orWhere('state', '=', '1')->get();
        return response()->json( compact('Req'));
    }

    public function reqinf($id) {
        $Req = Req::where('id',$id)->get();
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();
        return response()->json( compact('Req','Servs','Serv'));


    }

    public function flow($id) {
        $Req = Req::find($id) ;
        $provider = Prov::where('id' , $Req->prov_id)->get();
        return response()->json( compact('Req','provider'));


    }

    public function cupdate(Request $request, $id) {
        


        $Req = Req::findOrFail($id);
        $Req->state =  $request->state ;
    
        $Req->save();
        if($Req->state == "4" || $Req->state == "5" )
        {
            $provider = Prov::find($Req->prov_id);
            $provider->wallet =  $Req->Prov->wallet + $Req->tax;
            $provider->save();
        }

        
      $Not = new Not() ;
      $Not->users_id =  $request->user()->id ;
      $Not->pro_id =  $Req->Prov->id ;
      $Not->nots =  $request->nots . $request->user()->id;
      $Not->kind =  $request->kind ;
      $Not->save();

    
     
        return response()->json( compact('Req','Not'));
    }


    public function reat($id) {
        $provider = Prov::find($id);
        return response()->json(  compact('provider'));


    }

    public function reatestore(Request $request ,$id) {


        $Reat = new Reat() ;
        $Reat->user_id =  $request->user()->id ;
        $Reat->prov_id =  $request->prov_id ;
        $Reat->reat =  $request->reat ;
        $Reat->save();

        $provider = Prov::findOrFail($id);
        $provider->reats =  Reat::where('prov_id' , $id)->avg('reat');
        $provider->save();

        return response()->json(  compact('provider'));
    }

    public function favstore(Request $request ,$id) {


        $Fav = new Fav() ;
        $Fav->user_id =  $request->user()->id ;
        $Fav->prov_id =  $request->prov_id ;
        $Fav->save();

        return response()->json(  compact('Fav'));
    }

    public function fav() {
        $Favs = Fav::get();
        return response()->json(  compact('Favs'));


    }

    public function Not(Request $request) {
        $Nots = Not::where('users_id' , $request->user()->id)->where('kind', '=', 'user')->get();
        return response()->json(  compact('Nots'));


    }
    public function ndestroy($id) {
        $Nots = Not::find($id) ;
        $Nots->delete();
        return response()->json( 'delete success');
    }
    public function orders() {
        $provider = Prov::where('reats', '>', '3')->get();
        return response()->json(  compact('provider'));


    }

    public function userprofile($id){
        $user = User::findOrFail($id);
        return response()->json( compact('user'));
    }

    public function updateprofile(Request $request, $id){
        $user = User::find($id);

        $user->name =  $request->name ;
        $user->phone =  $request->phone ;
        $user->email =  $request->email ;

        if(!is_null($request->image))
        {
        File::delete('uploads/user/'.$user->image);
        $originalImage= $request->file('image');
            $ext = $originalImage->getClientOriginalExtension();
            $thumbnailImage = Image::make($originalImage);
            $image ='cover_image' . '_' . time().  '.' . $ext;
            $originalImage->move(public_path('uploads/user') , $image);
            $thumbnailImage->resize(150,150);
        $user->image =  $image ;
        }

        $user->update();
        $user->save();

        return response()->json( compact('user'));
    }

    
    public function uupdate(Request $request, $id)
{
    $this->validate($request, [
        'old' => 'required',
        'password' => 'required|min:6|confirmed',
      ]);
      
      $user = User::find($id);
      $hashedPassword = $user->password;
  
      if (Hash::check($request->old, $hashedPassword)) {
        //Change the password
        $user->fill([
          'password' => Hash::make($request->password)
          ])->save();
          
        return response()->json('Your password has been changed.');
    }
    else {
        return response()->json('Your password has not been changed.');
    }   
}
public function umstore(Request $request) {


    $Ums = new Ums() ;
    $Ums->user_id =  $request->user()->id ;
    $Ums->masg =  $request->masg ;
    $Ums->save();

    return response()->json( compact('Ums'));
}



}
