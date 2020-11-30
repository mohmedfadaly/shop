@extends('layouts.app')





@section('content')
<div class="sucs">
  <div class="container">
    <div class="half"></div>
  </div>
  <div class="agree">
  <div class="container">
    <div class="blur">
      <div class="image"><img src="{{ asset('front/img/undraw_verified_tw20.png')}}"></div>
    </div>
    <h1>المديونية</h1>
    <p>{{ Auth::guard('prov')->user()->wallet }}ريال</p>

  
  <a class="btn btn-primary" href="{{ route('bank') }}" role="button">تسديد المديونية</a>
  </div>
  </div>
</div>
@endsection
