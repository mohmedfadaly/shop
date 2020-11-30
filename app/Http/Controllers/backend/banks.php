<?php

namespace App\Http\Controllers\backend;

use App\models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class banks extends backendController
{

    public function __construct(Bank $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $banks = Bank::paginate(10);
        return view('back_end.banks.index',compact('banks'));
    }

    public function create() {
        return view('back_end.banks.create');

    }

    public function store(Request $request) {
        $request->validate([
            'name' =>  'required|max:191',
            'num' =>  'required|min:15|numeric',
            'ipan' =>  'required|max:191',
           
        ]);
        $Bank = new Bank() ;
        $Bank->name =  $request->name ;
        $Bank->num =  $request->num ;
        $Bank->ipan =  $request->ipan ;
        
        $Bank->save();
        return redirect()->route('banks.index')->with('status', 'التخصص انشأ');
    }

    public function edit($id) {
        $Bank = Bank::find($id);
        return view('back_end.banks.edit', compact('Bank'));


    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' =>  'required|max:191',
            'num' =>  'required|numeric',
            'ipan' =>  'required|max:191',
        
        ]);
        $Bank = Bank::find($id) ;
        $Bank->name =  $request->name ;
        $Bank->num =  $request->num ;
        $Bank->ipan =  $request->ipan ;
       
        $Bank->save();
        return redirect()->route('banks.index')->with('status', 'التخصص تم التعديل !');
    }

    public function destroy($id) {
        $Bank = Bank::find($id) ;
        $Bank->delete();
        return redirect()->route('banks.index')->with('status', 'النخصص مسح !');
    }
}
