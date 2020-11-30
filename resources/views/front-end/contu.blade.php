@extends('layouts.app')





@section('content')
<div class="contact">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>اتصل بنا</span></h1>
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
   <div class="agree">
  <div class="container">
    <div class="blur">
    <div class="image"><img src="{{ asset('front/img/undraw_my_password_d6kg(1).png')}}"></div>
    </div>
  </div>
  </div>
  <div class="mass">
    <div class="container">
    <form role="form" class="contact100-form validate-form" action="{{ route('content.store') }}" method="POST">
            @csrf 
      <div class="form-group">
    <label for="exampleFormControlTextarea1">الرسالة</label>
    <textarea name="masg" class="form-control" id="exampleFormControlTextarea1" placeholder="اكتب الرسالة هنا"></textarea>
    </div>
     <button type="submit" class="btn">ارسال</button>
    </form>
    </div>


    <div class="footer text-center">
    <div class="container">
      <h2>او عبر مواقع التواصل الاجتماعية</h2>

      <div class="social">
        <div class="row">
          <div class="col">
            <div class="ico_b"><a href="#"  class="card-link"><i class="fa fa-bell"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_t"><a href="#"  class="card-link"><i class="fa fa-twitter"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_i"><a href="#"  class="card-link"><i class="fa fa-instagram"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_w"><a href="#"  class="card-link"><i class="fa fa-whatsapp"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_g"><a href="#"  class="card-link"><i class="fa fa-telegram"></i></a></div>
          </div>
        </div>
      </div>
      </div>
     </div>

    
  </div>

  

  

</div>
@endsection
