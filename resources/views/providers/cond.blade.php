@extends('layouts.app')





@section('content')
<div class="about">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>من نحن</span></h1>
            <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
  </div>
   <div class="agree">
  <div class="container">
    <div class="blur">
    <div class="image"><img src="{{ asset('front/img/undraw_my_password_d6kg(1).png')}}"></div>
    </div>
  </div>
  </div>
<div class="list">
  <div class="container">
    <ul>
      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل
        هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص</p>
      </li>

      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل  يمكن ان يستبدل</p>
      </li>
      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل</p>
      </li>
    </ul>
  </div>
</div>


  

</div>
@endsection
