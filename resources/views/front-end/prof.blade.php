@extends('layouts.app')





@section('content')
<div class="prof">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>الملف الشخصي</span></h1>
            <a href="javascript:void(0);" class="menu_icon"></a>
            <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
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

  <form class="form-group" action="{{ route('update.profileuser', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT') 
  <div class="agree">
    <div class="container">
      <div class="image">
        <img src="{{ url('uploads/user/'.$user->image) }}">
        <div class="iconc"> <input type="file" name="image" id="upload" class="upload-box">
    <label for="file" class="btn-3"><i class="fa fa-camera"></i></label></div>

          <div class="write">
          <h2>{{ $user->name }}</h2>
          <p>{{ $user->email }}</p>
        </div>
      </div>
    </div>
  </div>
<div class="change">
  <div class="container">
  
       <div class="form-group">
          <label for="exampleInputphone">اسم المستخدم</label>
          <input type="text" class="form-control" name="name" id="exampleInputphone" value="{{ $user->name }}" placeholder="الرجاء ادخال الاسم">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">رقم الجوال</label>
          <input type="phone" class="form-control" name="phone" id="exampleInputphone" value="{{ $user->phone }}" placeholder="الرجاء ادخال رقم الجوال">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">البريد الالكتروني</label>
          <input type="text" class="form-control" name="email" id="exampleInputphone" value="{{ $user->email }}" placeholder="الرجاء ادخال البريد الالكتروني">
        </div>
        <div class="row">
          <div class="col">
                   <button type="submit" class="btn">حفظ التغيرات</button>
          </div>
          <div class="col">
                   <a class="btn btn-primary" href="{{ route('user.pass', ['id' => Auth::user()->id]) }}" role="button">تغير الباسورد</a>
          </div>
        </div>
 

      
    </div>
  </div>
  </form>
</div>
@endsection
