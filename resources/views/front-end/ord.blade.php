@extends('layouts.app')

@section('title' , "العروض")



@section('content')
<div class="fav">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col-sm-12">
      <h1><span>العروض المميزة</span></h1>
      <a href="javascript:void(0);" class="menu_icon"></a>
      <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
    </div>
    
    </div>
      
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

<!--reate-->
<div class="reat">
  <div class="container">
    
    <div class="row">
    @foreach($provider as $Prov)
    
      <div class="col-sm-12">
      <a href="{{ route('front.provider' , ['id' => $Prov->id]) }}" style="color:#000;">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$Prov->image_i) }}">
        <div class="cot">
        <h3>{{ $Prov->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $Prov->address }}</p>
        </div>
        <div class="ret"> <img src="{{ asset('front/img/star(-1.png')}}"><span>{{ $Prov->reats }}</span></div>
      </div>
      </a>
      </div>
      @endforeach
     
    </div>
  </div>
</div>
<!--end reate-->


</div>
@endsection
