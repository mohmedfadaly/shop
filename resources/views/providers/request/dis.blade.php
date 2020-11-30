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
    
    <h1>للاسف حاول مجددا</h1>
    <p>{{ $Req->user->name }} لقد رفض الطلب الخاص ب</p>
    <form class="form-group"action="{{ route('dis.update', $Req->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        <input type="hidden"  value="{{$Req->user->id}}" id="users_id" name="users_id">
                        <input type="hidden"  value=" {{Auth::guard('prov')->user()->name}}      تم رفض طلبك من قبل" id="nots" name="nots">
                        <input type="hidden"  value="user" id="kind" name="kind">
                         <input type="hidden"  value="1" id="state" name="state">
                         <div class="form-group">
                        <label for="exampleFormControlTextarea1">الاسباب</label>
                        <textarea class="form-control" value="" name="why" id="exampleFormControlTextarea1" placeholder="اكتب ملاحظاتك هنا"></textarea>
                        </div>
                         <button type="submit" class="btn btn-primary">القائمة الرائيسية</button>
                </form>
  </div>
  </div>
</div>
@endsection
