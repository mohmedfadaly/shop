<?php

namespace App\Http\Controllers\backend;

use App\models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class sections extends backendController
{

    public function __construct(Section $model)
    {
        parent::__construct($model);
    }

      //
      public function index() {

        $sections = Section::paginate(10);
        return view('back_end.sections.index',compact('sections'));
    }

    public function create() {
        return view('back_end.sections.create');

    }

    public function store(Request $request) {
        $request->validate([
            'name' =>  'required|max:191',
           
        ]);
        $Section = new Section() ;
        $Section->name =  $request->name ;
        
        $Section->save();
        return redirect()->route('sections.index')->with('status', 'التخصص انشأ');
    }

    public function edit($id) {
        $Section = Section::find($id);
        return view('back_end.sections.edit', compact('Section'));


    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' =>  'required|max:191',
        
        ]);
        $Section = Section::find($id) ;
        $Section->name =  $request->name ;
       
        $Section->save();
        return redirect()->route('sections.index')->with('status', 'التخصص تم التعديل !');
    }

    public function destroy($id) {
        $Section = Section::find($id) ;
        $Section->delete();
        return redirect()->route('sections.index')->with('status', 'النخصص مسح !');
    }
}
