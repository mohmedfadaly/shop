@extends('layouts.app')

@section('title' , $provider->name)



@section('content')
<div class="felt">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col-sm-12">
      <h1> <i class="fa fa-th-large"> </i><span>تفاصيل البيوتي سنتر</span></h1>
      <a href="javascript:void(0);" class="menu_icon"></a>
      <a   class="card-link" href="{{ route('nots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
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
<div class="img">
      <div class="container">
        <div class="row">
        <div class="col-sm-12">
          <img src="{{ url('uploads/ii/'.$provider->image_i) }}">
          </div>
          <div class="cont col-sm-12">
          <h1>{{ $provider->name }}</h1>

          <div class="cot">
          <h3>العنوان</h3> 
          <p> <i class="fa fa-map-marker"></i>{{ $provider->address }}</p>
          </div>

          <div class="cot">
          <h3>موعيد العمل</h3> 
          <p> <i class="fa fa-clock-o"></i> مفتوح 9صباحا مغلق 10مسائا</p>
          </div>
          <div class="ret"> <img src="{{ asset('front/img/star(-1.png')}}"><span>{{ $provider->reats }}</span></div>
        </div>
        </div>
      </div>
    </div>


  <div class="des">
    <div class="container">
      <h3>تفاصيل بيوتي سنتر</h3> 
          <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل</p>
          <form class="contact100-form validate-form"action="{{ route('fav.store', $provider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                         
                        <input type="hidden"  value="{{$provider->id}}" id="prov_id" name="prov_id">
                         <button type="submit" class="btn"><i class="fa fa-heart" aria-hidden="true"></i></button>
                         
                         
                </form>
                       <a class="btn btn-primary" href="{{ route('reqsin.create', ['id' => $provider]) }}" role="button">حجز خدمة</a>

    </div>
  </div>
</div>
@endsection
