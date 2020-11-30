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
    
    <h1>شكرا لك</h1>
    <p>لقد وافقت علي الحجز من {{ $Req->user->name }} وتم نقله للطلبات الحالية</p>
    <form class="contact100-form validate-form"action="{{ route('sucs.update', $Req->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        <input type="hidden"  value="{{$Req->user->id}}" id="users_id" name="users_id">
                        <input type="hidden"  value=" {{Auth::guard('prov')->user()->name}}      تم قبول طلبك من قبل" id="nots" name="nots">
                        <input type="hidden"  value="user" id="kind" name="kind">
                        
                         <input type="hidden"  value="2" id="state" name="state">
                         <button type="submit" class="btn btn-primary">القائمة الرائيسية</button>
                </form>
  </div>
  </div>
</div>

@endsection
