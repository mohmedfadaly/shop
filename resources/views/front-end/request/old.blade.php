@extends('layouts.app')





@section('content')
<div class="order">
  <div class="container">
    <div class="header">
      <h1> <i class="fa fa-th-large"> </i><span>الطلبات الحالية</span></h1>
      <a href="javascript:void(0);" class="menu_icon"></a>
      <a   class="card-link" href="{{ route('nots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
    </div>
  </div>
  <div id="menu">
<div class="ime">
  
  <img src="{{ url('uploads/user/'. Auth::user()->image) }}" alt="...">
  <div class="write">
  <h2>{{  Auth::user()->name }}</h2>
  <p>{{  Auth::user()->email }}</p>
  </div>
</div>


<ul>
    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i><span>الرائيسية</span></a></li>
    <li><a href="{{ route('profile', ['id' => Auth::user()->id]) }}"><i class="fa fa-user"></i><span>الملف الشخصي</span></a></li>
    <li><a href="{{ route('nots') }}"><i class="fa fa-bell"></i><span>الاشعارات</span></a></li>
    <li><a href="{{ route('fav') }}"><i class="fa fa-heart"></i><span>المفضلة</span></a></li>
    <li><a href="{{ route('about') }}"><i class="fa fa-user-o"></i><span>من نحن</span></a></li>
    <li><a href="{{ route('cond') }}"><i class="fa fa-list-ol"></i><span>الشروط والاحكام</span></a></li>
    <li><a href="{{ route('content') }}"><i class="fa fa-phone"></i><span>اتصل بنا</span></a></li>
  </ul>
  <a class="card-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i><span>تسجيل خروج</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
</div>
  <!--ord-->
  <div class="ord">
      <div class="container">
      <div class="act">
      <div class="row">

      <div class="col"><a class="btn btn-primary" href="{{ route('new') }}" role="button">الطلبات الحالية</a></div>
        <div class="col"><a class="btn btn-primary" href="{{ route('old') }}" role="button">الطلبات السابقة</a></div>
      </div>
      </div>
            <!--rate-->
               
            @foreach($Req as $Req)
            @if(auth()->user() && $Req->user_id == auth()->user()->id)
  <div class="row">
      <div class="col-sm-12">
      <a href="{{ route('front.req' , ['id' => $Req->id]) }}" style="color:#000;">
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
      <div class="col"><a class="nav-link" href="#">  <i class="fa fa-home"></i>الرائيسية </a></div>
      <div class="col"><a class="nav-link " href="#"><i class="fa fa-list"></i>طلباتي </a></div>
      <div class="col"><a class="nav-link" href="#"><i class="fa fa-bookmark"></i>العروض</a></div>
    </div>
  </div>
</div>


<!--nav-->
</div>
@endsection
