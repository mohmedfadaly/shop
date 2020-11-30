@extends('layouts.app')





@section('content')
<div class="order">
  <div class="container">
    <div class="header">
      <h1> <i class="fa fa-th-large"> </i><span>الطلبات الحالية</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
    </div>
  </div>

  <!--ord-->
  <div class="ord">
      <div class="container">
      <div class="act">
      <div class="row">

        <div class="col"><a class="btn btn-primary" href="{{ route('pnew') }}" role="button">الطلبات الحالية</a></div>
        <div class="col"><a class="btn btn-primary" href="{{ route('pold') }}" role="button">الطلبات السابقة</a></div>
      </div>
      </div>
            <!--rate-->
            @foreach($Req as $Req)
            @if($Req->prov_id == Auth::guard('prov')->user()->id)
  <div class="row">
      <div class="col-sm-12">
      <a href="{{ route('prov.req' , ['id' => $Req->id]) }}" style="color:#000;">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$Req->Prov->image_i) }}">
        <div class="cot">
        <h3>{{ $Req->Prov->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $Req->Prov->address }}</p>
        </div>
        <div class="num"><p>رقم الطلب</p><p>{{ $Req->id }}</p></div>
        @if($Req->state == '5')
        <div class="numm"><p>الطلب مقبول</p></div>
        @endif
        @if($Req->state == '1')
          <div class="nums"><p>الطلب مرفوض</p></div>
          @endif
      </div>
      </a>
      </div>


  </div> 
  
  @endif
  @endforeach
 



<!--nav-->
<div class="nav">
  <div class="container">
    <div class="row">
    <div class="col"><a class="nav-link" href="{{ route('start') }}">  <i class="fa fa-home"></i>الرائيسية </a></div>
      <div class="col"><a class="nav-link " href="{{ route('pnew') }}"><i class="fa fa-list"></i>طلباتي </a></div>
      <div class="col"><a class="nav-link" href="{{ route('wallet') }}"><i class="fa fa-briefcase"></i>المحفظة</a></div>
    </div>
  </div>
</div>


<!--nav-->
</div>
@endsection
