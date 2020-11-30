@extends('layouts.app')





@section('content')
<div class="review">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col">
      <h1> <i class="fa fa-th-large"> </i><span>متابعة الطلب</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
       <a href="#"><i class="fa fa-arrow-left"></i></a>
    </div>
    </div>
      
    </div>

    
  </div>
  <div class="line">
    <div class="container">
      <div class="row">
        <div class="col"><h2>الخدمة قايدا لانتظار</h2></div>
        <div class="col"><div class="new">
        @if($Req->state == '0' || $Req->state == '2'|| $Req->state == '3' || $Req->state == '4' || $Req->state == '5')
        <div class="new1"></div>
        @endif</div></div>
        <div class="col"><p>{{$Req->created_at}}</p>	</div>
      </div>
      <div class="row">
        <div class="col"><div class="emp"></div></div>
        <div class="col"><div class="hero"></div></div>
        <div class="col"><div class="emp"></div></div>
      </div>

      <div class="row ted">
        <div class="col"><h2>تم تاكيد حجز الخدمة</h2></div>
        <div class="col"><div class="new">@if($Req->state == '2' || $Req->state == '3' || $Req->state == '4' || $Req->state == '5')
        <div class="new1"></div>
        @endif</div></div>
        <div class="col"><p>{{$Req->updated_at}}</p></div>
      </div>

      <div class="row">
        <div class="col"><div class="emp"></div></div>
        <div class="col"><div class="hero"></div></div>
        <div class="col"><div class="emp"></div></div>
      </div>

      <div class="row ted">
        <div class="col"><h2>المقدم فالطريق اليك</h2></div>
        <div class="col"><div class="new">@if($Req->state == '3' || $Req->state == '4' || $Req->state == '5')
        <div class="new1"></div>
        @endif</div></div>
        <div class="col"><p>{{$Req->updated_at}}</p></div>
      </div>

      <div class="row">
        <div class="col"><div class="emp"></div></div>
        <div class="col"><div class="hero"></div></div>
        <div class="col"><div class="emp"></div></div>
      </div>

      <div class="row ted">
        <div class="col"><h2>تم الانتهاء من الخدمة</h2></div>
        <div class="col"><div class="new">@if($Req->state == '4' || $Req->state == '5')
        <div class="new1"></div>
        @endif</div></div>
        <div class="col"><p>{{$Req->updated_at}}</p></div>
      </div>
      <form class="contact100-form validate-form"action="{{ route('sucs.update', $Req->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        @if($Req->state == '2')

                        <input type="hidden"  value="{{$Req->user->id}}" id="users_id" name="users_id">
                        <input type="hidden"  value=" {{Auth::guard('prov')->user()->name}}        المقدم فالطريق اليك من قبل" id="nots" name="nots">
                        <input type="hidden"  value="user" id="kind" name="kind">
                         <input type="hidden"  value="3" id="state" name="state">
                         <button type="submit" class="btn btn-primary">المقدم فالطريق اليك</button>
                         @endif

                         @if($Req->state == '3')

                         <input type="hidden"  value="{{$Req->user->id}}" id="users_id" name="users_id">
                        <input type="hidden"  value=" {{Auth::guard('prov')->user()->name}}     تم الانتهاء من الخدمة من قبل" id="nots" name="nots">
                        <input type="hidden"  value="user" id="kind" name="kind">
                         <input type="hidden"  value="4" id="state" name="state">
                         <button type="submit" class="btn btn-primary">تم الانتهاء من الخدمة</button>
                         @endif
                         
                </form>
    </div>
  </div>


</div>
@endsection
