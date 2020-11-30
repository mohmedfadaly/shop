<?php

namespace App\Http\Controllers\backend;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\models\Trans;
use App\models\Prov;
use DB;

class transes extends backendController
{

    public function __construct(Trans $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $trans = Trans::paginate(10);
        return view('back_end.trans.index',compact('trans'));
    }


    public function edit($id) {
        $Trans = Trans::find($id);
        $provider = Prov::where('id' , $Trans->prov_id)->get();
        return view('back_end.trans.edit', compact('Trans','provider'));


    }

    public function update(Request $request, $id) {
      


        $Trans = Trans::find($id) ;
        $Trans->state =  $request->state ;
       
        $Trans->save();

        if($Trans->state == "1")
        {
            $provider = Prov::find($Trans->prov_id);
            $provider->wallet =  $request->wallet - $Trans->cash;
            $provider->save();
        }
        return redirect()->route('trans.index')->with('status', 'التخصص تم التعديل !');
    }

    public function destroy($id) {
        $Trans = Trans::find($id) ;
        $Trans->delete();
        return redirect()->route('trans.index')->with('status', 'النخصص مسح !');
    }
}
