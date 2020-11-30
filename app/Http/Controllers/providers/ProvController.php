<?php

namespace App\Http\Controllers\providers;
use App\models\Prov;
use App\models\Req;
use App\models\User;
use App\models\Serv;
use App\models\Section;
use App\models\Req_serv;
use App\models\Bank;
use App\models\Trans;
use App\models\Pms;
use GuzzleHttp\Client;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use File;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;
use FCM;
use App\models\Not;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
class ProvController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:prov');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Prov = Prov::orderBy('id' , 'desc');
        if(request()->has('search') && request()->get('search') != ''){
            $Prov = $Prov->where('name' , 'like' , "%".request()->get('search')."%");
        }
        $Prov = $Prov->paginate(30);
        return view('welcome',compact('Prov'));
    }

    public function index2(Request $request)
    {
        $input = $request->all();
        $fcm_token = $input['token'];
        $Prov_id = $input['Prov_id'];
        $Prov = Prov::findOrFail($Prov_id);
        $Prov->fcm_token = $fcm_token;
        $Prov->update();
        $Prov->save();
        return response()->json([
            'sucess' => true,
            'message' => 'Prov Updated Successfully',
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


    public function start()
    {
        $Req = Req::where('state', '=', '0' )->where('prov_id' , Auth::guard('prov')->user()->id)->get();
        return view('start',compact('Req'));
    }

    public function about()
    {
       
        return view('providers.about');
    }

    public function cond()
    {
       
        return view('providers.cond');
    }

    public function wallet()
    {
       
        return view('providers.wallet');
    }

    public function bank()
    {
        $banks = Bank::get();
        return view('providers.bank',  compact('banks'));
    }

    public function banks($id)
    {
        $banks = Bank::findOrFail($id);
        return view('providers.pay',  compact('banks'));
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
        $Trans->prov_id = Auth::guard('prov')->user()->id;
       
        $Trans->save();
        return redirect()->route('start');
    }

    public function reqinf($id) {
        $Req = Req::where('id',$id)->get();
        $Serv = Serv::get();
        $Servs = Req_serv::where('req_id' , $id)->pluck('ser_id')->toArray();
        return view('providers.request.info',  compact('Req','Servs','Serv'));


    }

    public function flow($id) {
        $Req = Req::find($id) ;
        return view('providers.request.flow',  compact('Req'));


    }

    public function sucs($id) {
        $Req = Req::findOrFail($id);
        
       
        return view('providers.request.sucs', compact('Req'));

    }

    public function rupdate(Request $request, $id) {
        


        $Req = Req::findOrFail($id);
        $Req->state =  $request->state ;
        $Req->save();
        $Not = new Not() ;
        $Not->pro_id =  Auth::guard('prov')->user()->id ;
        $Not->users_id =  $request->users_id ;
        $Not->nots =  $request->nots ;
        $Not->kind =  $request->kind ;
        $Not->save();
    
        

        $title = 'new message from : '.Auth::guard('prov')->user()->name;
        $result = $this->fcm_send($Not->user->fcm_token, $Not->nots, '', $title );
         return redirect()->route('start', compact('result'));
    }

    public function dis(Request $request, $id) {
        $Req = Req::findOrFail($id);
        

        return view('providers.request.dis', compact('Req'));

    }

    public function pNot() {
        $Nots = Not::where('pro_id' , Auth::guard('prov')->user()->id)->where('kind', '=', 'prov')->get();
        return view('providers.nots',  compact('Nots'));


    }

    public function pndestroy($id) {
        $Nots = Not::find($id) ;
        $Nots->delete();
        return redirect()->back();
    }
    public function pandestroy() {
        $Nots = Not::where('pro_id' , Auth::guard('prov')->user()->id)->where('kind', '=', 'prov')->delete();
        
        return redirect()->back();
    }

    public function dupdate(Request $request, $id) {
        

        $Req = Req::find($id);
        $Req->state =  $request->state ;
        $Req->why =  $request->why ;
         $Req->update();
        $Req->save();

        $Not = new Not() ;
        $Not->pro_id =  Auth::guard('prov')->user()->id ;
        $Not->users_id =  $request->users_id ;
        $Not->nots =  $request->nots ;
        $Not->kind =  $request->kind ;
        $Not->save();

        $title = 'new message from : '.auth()->user()->name;
        $result = $this->fcm_send($Not->user->fcm_token, $Not->nots, '', $title );
        if ($result['success'] == 0) {
           return $this->sendError(' send  msg failed', $result);
        }
    
        return redirect()->route('start')->with($result);
    }

    public function pnew() {

        $Req = Req::where('state', '=', '0' )->orWhere('state', '=', '2')->orWhere('state', '=', '3')->orWhere('state', '=', '4')->get();
        return view('providers.request.new',compact('Req'));
    }

    public function pold() {

        $Req = Req::where('state', '=', '5' )->orWhere('state', '=', '1')->get();
        return view('providers.request.old',compact('Req'));
    }


    ///*******servs***** */

    public function servindex() {
        $servs = Serv::where('prov_id' , Auth::guard('prov')->user()->id)->get();
        return view('providers.servs.index',compact('servs'));
    }

    public function servcreate() {
        return view('providers.servs.create');

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
        $Serv->prov_id = Auth::guard('prov')->user()->id;

        
        $Serv->save();
        return redirect()->route('servs.index')->with('status', 'التخصص انشأ');
    }

    public function servedit($id) {
        $Serv = Serv::find($id);
        return view('providers.servs.edit', compact('Serv'));


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
        $Serv->prov_id = Auth::guard('prov')->user()->id;
        $Serv->save();
        return redirect()->route('servs.index')->with('status', 'التخصص تم التعديل !');
    }

    public function servdestroy($id) {
        $Serv = Serv::find($id) ;
        $Serv->delete();
        return redirect()->route('servs.index')->with('status', 'النخصص مسح !');
    }


    public function profile($id , $slug = null){
        $Prov = Prov::findOrFail($id);
        return view('providers.prof' , compact('Prov'));
    }

    public function uprofile(Request $request, $id , $slug = null){
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

        return redirect()->route('start');
    }

    public function pass($id , $slug = null){
        $Prov = Prov::findOrFail($id);
        return view('providers.pass' , compact('Prov'));
    }



    public function pupdate(Request $request, $id , $slug = null)
{
    $this->validate($request, [
        'old' => 'required',
        'password' => 'required|min:6|confirmed',
      ]);
      
      $Prov = Prov::find(Auth::id());
      $hashedPassword = $Prov->password;
  
      if (Hash::check($request->old, $hashedPassword)) {
        //Change the password
        $Prov->fill([
          'password' => Hash::make($request->password)
          ])->save();
          
        $request->session()->flash('success', 'Your password has been changed.');
        return redirect()->route('start');
    }
    else {
        $request->session()->flash('failure', 'Your password has not been changed.');
        return back();
    }   
}
    

public function pms() {
    return view('providers.contp');


}

public function pmstore(Request $request) {


    $Pms = new Pms() ;
    $Pms->pro_id =  Auth::guard('prov')->user()->id;
    $Pms->masg =  $request->masg ;
    $Pms->save();

    return redirect()->route('start')->with('status', 'video was created !');
}
   

}
