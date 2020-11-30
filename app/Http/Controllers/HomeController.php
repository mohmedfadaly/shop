<?php

namespace App\Http\Controllers;
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
use View;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $User = User::orderBy('id' , 'desc');
        if(request()->has('search') && request()->get('search') != ''){
            $User = $User->where('name' , 'like' , "%".request()->get('search')."%");
        }
        $User = $User->paginate(30);
        
        return view('home',compact('User'));
    }
    public function index2(Request $request)
    {
        $input = $request->all();
        $fcm_token = $input['token'];
        $user_id = $input['user_id'];
        $user = User::findOrFail($user_id);
        $user->fcm_token = $fcm_token;
        $user->update();
        $user->save();
        return response()->json([
            'sucess' => true,
            'message' => 'User Updated Successfully',
        ]);
    }


    public function fcm_send($token, $body, $data, $title)
    {
         $server_key = 'AAAAyy559X0:APA91bHujaUAXIEaTw4s71q2HVLUBX2s1QlRtnss4K5X00lClOprkxDjWqGfRdfSvDy5BlbpkVsrRYe-M_qP73s9YnItiG_eTIU7UOMOvyEbmlMRHK7YrtpM1XrgU4R8Esi71u-cDH_L';
        $push_url = 'https://fcm.googleapis.com/fcm/send';
        if (!is_array($token)) {
            $token = [$token];
        }
        // $array_token =array();
        $msg =
            [
                'body' => $body,
                'title' => $title,
                'click_action' => 'home'
                //'custom_url'   => $url
            ];
        $fields =
            [
                'registration_ids' => $token,
                'notification' => $msg,
            ];
        if (!empty($data)) {

            $fields['data'] = $data;
        }
        $headers =
            [
                'Authorization' => 'key=' . $server_key,
                'Content-Type' => 'application/json'
            ];
        //        dd($fields);
        $client = new Client();
        $response = $client->post($push_url, [
            'headers' => $headers,
            'body' => json_encode($fields)
        ]);
        $result = json_decode( $response->getBody(), true );
        return  $result;
    } //end of // push notification function



    public function home()
    {

        $sections = Section::paginate(10);
        $providers = Prov::orderBy('reats' , 'desc')->paginate(10);
        return view('home', compact('sections','providers'));
    }
    public function section($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('id' , 'desc');
        if(request()->has('search') && request()->get('search') != ''){
            $providers = $providers->where('name' , 'like' , "%".request()->get('search')."%");
        }
        $providers = $providers->get();
        return view('front-end.section.index' , compact('providers' ,'section'));
    }

    public function top($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('reats' , 'desc')->get();
        return view('front-end.section.index' , compact('providers' ,'section'));
    }

    public function bottom($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('id' , 'ASC')->get();
        return view('front-end.section.index' , compact('providers' ,'section'));
    }

    public function near($id){
        $section = Section::findOrFail($id);
        $providers = Prov::where('sec_id' , $id)->orderBy('id' , 'desc')->get();


        $latitude = Auth::user()->latitude;
        $longitude = Auth::user()->longitude;
        $radius = 10;

        $providers          =       DB::table("providers");

        $providers          =       $providers->where('sec_id' , $id)->select("*", DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. ")) * sin(radians(latitude))) AS distance"));
        $providers          =       $providers->having('distance', '<', 20);
        $providers          =       $providers->orderBy('distance', 'asc');

        $providers          =       $providers->get();


        return view('front-end.section.near' , compact('providers' ,'section'));
    }


    public function provider($id){
        $provider = Prov::findOrFail($id);
        return view('front-end.provider.index' , compact('provider'));
    
    }
   

    public function reqcreate($id) {
        $provider = Prov::findOrFail($id);
        $Serv = Serv::where('prov_id' , $id)->get();
        return view('front-end.request.index', compact('provider','Serv'));

    }
    public function reqocreate($id) {
        $provider = Prov::findOrFail($id);
        $Serv = Serv::where('prov_id' , $id)->get();
        return view('front-end.request.index2', compact('provider','Serv'));

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
        $Req->user_id =  auth()->user()->id ;
        $Req->time_from =  $request->time_from ;
        $Req->time_to =  $request->time_to ;
        $Req->address =  $request->address ;
        $Req->longitude =  $request->longitude ;
        $Req->latitude =  $request->latitude ;
        $Req->date =  $request->date ;
        $Req->des =  $request->des ;
        $Req->Total =  $request->Total ;
        $Req->tax =  $request->tax ;
        $Req->active =  $request->active ;
        
        $Req->why =  $request->why ;
        $Req->save();
        $Req->Servs()->attach($request->serv);
        
       // dd($Req->id); 
        
       $id = $Req->id;
      // dd($id);

      $Not = new Not() ;
        $Not->users_id =  auth()->user()->id ;
        $Not->pro_id =  $request->pro_id ;
        $Not->nots =  $request->nots ;
        $Not->kind =  $request->kind ;
        $Not->save();

         $title = 'new message from : '.auth()->user()->name;
        $result = $this->fcm_send($Not->Prov->fcm_token, $Not->nots, '', $title );
        if ($result['success'] == 0) {
           return $this->sendError(' send  msg failed', $result);
        }         
     
        
        return redirect()->route('cheak', compact('id','result'));
    }

    public function show($id) {
        $Req = Req::findOrFail($id);
        

        return view('front-end.request.show', compact('Req'));

    }

    public function cheak($id) {
        $Req = Req::findOrFail($id);
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();

        return view('front-end.request.cheak', compact('Req','Servs','Serv'));

    }

    public function cheakupdate(Request $request, $id) {
        $Req = Req::findOrFail($id);
        $Req->Total =  $request->Total ;
        $Req->tax =  $request->tax ;
        $Req->save();
        return redirect()->route('home')->with('status', 'video was created !');

    }

    public function new() {

        $Req = Req::where('state', '=', '0' )->orWhere('state', '=', '2')->orWhere('state', '=', '3')->orWhere('state', '=', '4')->get();
        return view('front-end.request.new',compact('Req'));
    }
    public function old() {

        $Req = Req::where('state', '=', '5' )->orWhere('state', '=', '1')->get();
        return view('front-end.request.old',compact('Req'));
    }

    public function reqinf($id) {
        $Req = Req::where('id',$id)->get();
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();
        return view('front-end.request.info',  compact('Req','Servs','Serv'));


    }

    public function flow($id) {
        $Req = Req::find($id) ;
        $provider = Prov::where('id' , $Req->prov_id)->get();
        return view('front-end.request.flow',  compact('Req','provider'));


    }

    public function cupdate(Request $request, $id) {
        


        $Req = Req::findOrFail($id);
        $Req->state =  $request->state ;
    
        $Req->save();
        if($Req->state == "4" || $Req->state == "5" )
        {
            $provider = Prov::find($Req->prov_id);
            $provider->wallet =  $request->wallet + $Req->tax;
            $provider->save();
        }

        
      $Not = new Not() ;
      $Not->users_id =  auth()->user()->id ;
      $Not->pro_id =  $request->pro_id ;
      $Not->nots =  $request->nots ;
      $Not->kind =  $request->kind ;
      $Not->save();

     
            $title = 'new message from : '.auth()->user()->name;
        $result = $this->fcm_send($Not->Prov->fcm_token, $Not->nots, '', $title );
        if ($result['success'] == 0) {
           return $this->sendError(' send  msg failed', $result);
        }         
     
     
        return redirect()->route('home')->with($result);
    }

    public function reat($id) {
        $provider = Prov::find($id);
        return view('front-end.request.reat',  compact('provider'));


    }

    public function reatestore(Request $request ,$id) {


        $Reat = new Reat() ;
        $Reat->user_id =  auth()->user()->id ;
        $Reat->prov_id =  $request->prov_id ;
        $Reat->reat =  $request->reat ;
        $Reat->save();

        $provider = Prov::findOrFail($id);
        $provider->reats =  Reat::where('prov_id' , $id)->avg('reat');
        $provider->save();

        return redirect()->route('home')->with('status', 'video was created !');
    }

 
    public function favstore(Request $request ,$id) {


        $Fav = new Fav() ;
        $Fav->user_id =  auth()->user()->id ;
        $Fav->prov_id =  $request->prov_id ;
        $Fav->save();

        return redirect()->back()->with('status', 'video was created !');
    }

    public function fav() {
        $Favs = Fav::where('user_id' , Auth::user()->id)->get();
        return view('front-end.provider.fav',  compact('Favs'));


    }

    public function Not() {
        $Nots = Not::where('users_id' , Auth::user()->id)->where('kind', '=', 'user')->get();
        return view('front-end.nots',  compact('Nots'));


    }

    public function ndestroy($id) {
        $Nots = Not::find($id) ;
        $Nots->delete();
        return redirect()->back();
    }

    public function andestroy() {
        $Nots = Not::where('users_id' , Auth::user()->id)->where('kind', '=', 'user')->delete();
        
        return redirect()->back();
    }


    public function orders() {
        $provider = Prov::where('reats', '>', '3')->get();
        return view('front-end.ord',  compact('provider'));


    }

    public function userprofile($id , $slug = null){
        $user = User::findOrFail($id);
        return view('front-end.prof' , compact('user'));
    }

    public function updateprofile(Request $request, $id , $slug = null){
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

        return redirect()->route('home');
    }

    public function upass($id , $slug = null){
        $user = User::findOrFail($id);
        return view('front-end.pass' , compact('user'));
    }



    public function uupdate(Request $request, $id , $slug = null)
{
    $this->validate($request, [
        'old' => 'required',
        'password' => 'required|min:6|confirmed',
      ]);
      
      $user = User::find(Auth::id());
      $hashedPassword = $user->password;
  
      if (Hash::check($request->old, $hashedPassword)) {
        //Change the password
        $user->fill([
          'password' => Hash::make($request->password)
          ])->save();
          
        $request->session()->flash('success', 'Your password has been changed.');
        return redirect()->route('home');
    }
    else {
        $request->session()->flash('failure', 'Your password has not been changed.');
        return back();
    }   
}

public function about()
{
   
    return view('front-end.about');
}

public function cond()
{
   
    return view('front-end.cond');
}
public function ums() {
    return view('front-end.contu');


}

public function umstore(Request $request) {


    $Ums = new Ums() ;
    $Ums->user_id =  auth()->user()->id ;
    $Ums->masg =  $request->masg ;
    $Ums->save();

    return redirect()->route('home')->with('status', 'video was created !');
}


}
