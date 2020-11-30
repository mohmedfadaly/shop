<?php

namespace App\Http\Controllers\backend;

use App\models\Pms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class pmsms extends backendController
{

    public function __construct(Pms $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $Pmss = Pms::paginate(10);
        return view('back_end.pmsgs.index',compact('Pmss'));
    }

    
    public function destroy($id) {
        $Pms = Pms::find($id) ;
        $Pms->delete();
        return redirect()->route('pmsgs.index')->with('status', 'النخصص مسح !');
    }
}
