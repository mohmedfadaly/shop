@extends('layouts.app')





@section('content')
<div class="pass">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>تغير كلمة المرور</span></h1>
            <a href="javascript:void(0);" class="menu_icon"></a>
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
  <div class="change">
  <div class="container">
  @if (Session::has('success'))
              <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif
            @if (Session::has('failure'))
              <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
            @endif
  <form action="{{ route('update.upass', $user->id) }}" method="post" role="form" class="form-horizontal">

  @csrf
                        @method('PUT') 
  
       <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور الحالية</label>
          <input id="password-field" type="password" class="form-control" name="old" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور الجديدة</label>
          <input id="password-field" type="password" class="form-control" name="password" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">تاكيد كلمةة المرور</label>
          <input id="password-field" type="password" class="form-control" name="password_confirmation" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
                   <button type="submit" class="btn">حفظ التغيرات</button>
 

      </form>
    </div>
  </div>

</div>
@endsection
