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
use App\models\Pms;
use GuzzleHttp\Client;
use App\models\Bank;
use App\models\Trans;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use File;
class provController extends Controller
{
    
    public function start()
    {
        $Req = Req::where('state', '=', '0' )->get();
        return response()->json(compact('Req'));
    }

    public function bank()
    {
        $banks = Bank::get();
        return response()->json(  compact('banks'));
    }

    public function banks($id)
    {
        $banks = Bank::findOrFail($id);
        return response()->json(  compact('banks'));
    }

    public function bstore(Request $request, $id) {
        $request->validate([
            'name' =>  'required|max:191',
            'num' =>  'required|numeric',
            'cash' =>  'required',
            'bank' =>  'required|max:191',
            'image' =>  'image|mimes:jpeg,png,jpg,gif|',
            'bank_id' =>  ['required'],
        
        ]);

        $originalImage= $request->file('image');
        $ext = $originalImage->getClientOriginalExtension();
        $thumbnailImage = Image::make($originalImage);
        $image ='image' . '_' . time().  '.' . $ext;
        $originalImage->move(public_path('uploads/p') , $image);
        $thumbnailImage->resize(150,150);


        $Trans = new Trans() ;
        $Trans->name =  $request->name ;
        $Trans->num =  $request->num ;
        $Trans->cash =  $request->cash ;
        $Trans->bank =  $request->bank ;
        $Trans->image =  $image ;
        $Trans->state =  $request->state ;
        $Trans->bank_id =  $request->bank_id ;
        $Trans->prov_id = $request->user()->id;
       
        $Trans->save();
        return response()->json(  compact('Trans'));
    }

    public function reqinf($id) {
        $Req = Req::where('id',$id)->get();
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();
        return response()->json(   compact('Req','Servs','Serv'));


    }
    public function flow($id) {
        $Req = Req::find($id) ;
        return response()->json( compact('Req'));


    }

    public function rupdate(Request $request, $id) {
        


        $Req = Req::findOrFail($id);
        $Req->state =  $request->state ;
        $Not = new Not() ;
        $Not->pro_id =  $request->user()->id;
        $Not->users_id =  $request->users_id ;
        $Not->nots =  $request->nots  .  $request->user()->id;
        $Not->kind =  $request->kind ;
        $Not->save();
    
        $Req->save();

       
    
        return response()->json( compact('Req','Not'));
    }

    public function dis(Request $request, $id) {
        $Req = Req::findOrFail($id);
        

        return response()->json(  compact('Req'));

    }

    public function dupdate(Request $request, $id) {
        

        $Req = Req::find($id);
        $Req->state =  $request->state ;
        $Req->why =  $request->why ;
         $Req->update();
        $Req->save();

        $Not = new Not() ;
        $Not->pro_id =  $request->user()->id;
        $Not->users_id =  $request->users_id ;
        $Not->nots =  $request->nots  .  $request->user()->id;
        $Not->kind =  $request->kind ;
        $Not->save();

        return response()->json( compact('Req','Not'));
    }

    public function pNot() {
        $Nots = Not::where('kind', '=', 'prov')->get();
        return response()->json(  compact('Nots'));


    }

    public function pndestroy($id) {
        $Nots = Not::find($id) ;
        $Nots->delete();
        return response()->json( 'delete success');
    }
    public function pnew() {

        $Req = Req::where('state', '=', '0' )->orWhere('state', '=', '2')->orWhere('state', '=', '3')->orWhere('state', '=', '4')->get();
        return response()->json(compact('Req'));
    }

    public function pold() {

        $Req = Req::where('state', '=', '5' )->orWhere('state', '=', '1')->get();
        return response()->json(compact('Req'));
    }

    public function servindex() {
        $servs = Serv::get();
        return response()->json(compact('servs'));
    }

    public function servstore(Request $request) {
        $request->validate([
            'name' =>  'required|max:191',
            'osalary' =>  'required',
            'salary' =>  'required',
            
           
        ]);
        $Serv = new Serv() ;
        $Serv->name =  $request->name ;
        $Serv->osalary =  $request->osalary ;
        $Serv->salary =  $request->salary ;
        $Serv->prov_id = $request->user()->id;

        
        $Serv->save();
        return response()->json(compact('Serv'));
    }
    public function servedit($id) {
        $Serv = Serv::find($id);
        return response()->json( compact('Serv'));


    }
    public function servupdate(Request $request, $id) {
        $request->validate([
            'name' =>  'required|max:191',
            'osalary' =>  'required',
            'salary' =>  'required',
        
        ]);
        $Serv = Serv::find($id) ;
        $Serv->name =  $request->name ;
        $Serv->osalary =  $request->osalary ;
        $Serv->salary =  $request->salary ;
        $Serv->prov_id = $request->user()->id ;
        $Serv->save();
        return response()->json( compact('Serv'));
    }

    public function servdestroy($id) {
        $Serv = Serv::find($id) ;
        $Serv->delete();
        return response()->json( 'delete success');
    }

    public function profile($id){
        $Prov = Prov::findOrFail($id);
        return response()->json( compact('Prov'));
    }

    public function uprofile(Request $request, $id){
        $Prov = Prov::find($id);

        $Prov->name =  $request->name ;
        $Prov->phone =  $request->phone ;
        $Prov->email =  $request->email ;

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

        $Prov->update();
        $Prov->save();

        return response()->json( compact('Prov'));
    }

    public function pass($id){
        $Prov = Prov::findOrFail($id);
        return response()->json( compact('Prov'));
    }

    public function pupdate(Request $request, $id)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
          ]);
          
          $Prov = Prov::find($id);
          $hashedPassword = $Prov->password;
      
          if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $Prov->fill([
              'password' => Hash::make($request->password)
              ])->save();
              
              return response()->json('Your password has been changed.');
            }
            else {
                return response()->json('Your password has not been changed.');
            }   
    }

    public function pmstore(Request $request) {


        $Pms = new Pms() ;
        $Pms->pro_id =  $request->user()->id ;
        $Pms->masg =  $request->masg ;
        $Pms->save();
    
        return response()->json( compact('Pms'));
    }

}
