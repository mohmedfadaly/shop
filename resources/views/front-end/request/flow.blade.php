@extends('layouts.app')





@section('content')
<div class="review">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col">
      <h1> <i class="fa fa-th-large"> </i><span>متابعة الطلب</span></h1>
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
      @if($Req->state == '4')
      <form class="contact100-form validate-form"action="{{ route('fin.update', $Req->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        <input type="hidden"  value="{{$Req->Prov->id}}" id="pro_id" name="pro_id">
                        <input type="hidden"  value=" {{auth()->user()->name}} لقد  تم    تاكيد الاستلام من" id="nots" name="nots">
                        <input type="hidden"  value="prov" id="kind" name="kind">
                         <input type="hidden"  value="5" id="state" name="state">
                         <input type="hidden"  value="{{$Req->Prov->wallet}}" id="wallet" name="wallet">
                         <button type="submit" class="btn btn-primary">تم الاستلام</button>
                         
                         
                </form>
                @endif
                @if($Req->state == '5')
                <a class="btn btn-primary" href="{{ route('front.reat', $Req->prov_id) }}" role="button">اضافة تقيم</a>
                @endif
    </div>
  </div>


</div>
@endsection
