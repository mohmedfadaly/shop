<?php

namespace App\Http\Controllers\backend;

use App\models\Ums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class msgs extends backendController
{

    public function __construct(Ums $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $Umss = Ums::paginate(10);
        return view('back_end.msgs.index',compact('Umss'));
    }

    
    public function destroy($id) {
        $Ums = Ums::find($id) ;
        $Ums->delete();
        return redirect()->route('msgs.index')->with('status', 'النخصص مسح !');
    }
}
