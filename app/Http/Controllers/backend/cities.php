<?php

namespace App\Http\Controllers\backend;

use App\models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class cities extends backendController
{

    public function __construct(City $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $cities = City::paginate(10);
        return view('back_end.cities.index',compact('cities'));
    }

    public function create() {
        return view('back_end.cities.create');

    }

    public function store(Request $request) {
        $request->validate([
            'name' =>  'required|max:191',
           
        ]);
        $City = new City() ;
        $City->name =  $request->name ;
        
        $City->save();
        return redirect()->route('cities.index')->with('status', 'التخصص انشأ');
    }

    public function edit($id) {
        $City = City::find($id);
        return view('back_end.cities.edit', compact('City'));


    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' =>  'required|max:191',
        
        ]);
        $City = City::find($id) ;
        $City->name =  $request->name ;
       
        $City->save();
        return redirect()->route('cities.index')->with('status', 'التخصص تم التعديل !');
    }

    public function destroy($id) {
        $City = City::find($id) ;
        $City->delete();
        return redirect()->route('cities.index')->with('status', 'النخصص مسح !');
    }
}
