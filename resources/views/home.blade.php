@extends('layouts.app')
@section('content')
<div class="home">
  <div class="container">
    <div class="header">
    <a href="javascript:void(0);" class="menu_icon"></a>
      
      <h1> <i class="fa fa-th-large"> </i><span>الرائيسية</span></h1>
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
<div class="slider">
    <div class="container">
      <div id="test" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#test" data-slide-to="0" class="active"></li>
          <li data-target="#test" data-slide-to="1"></li>
          <li data-target="#test" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('front/img/s1.png')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('front/img/s1.png')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('front/img/s1.png')}}" class="d-block w-100" alt="...">
          </div>
        </div>
      </div>
    </div>
</div>
<!--section-->
<div class="section">
  <div class="container">
 
    <h2>اختر القسم</h2>
    <div class="row">
    @foreach($sections as $section)
      <div class="col-sm-6 text-center">
      <div class="con">
         <a href="{{ route('front.section' , ['id' => $section->id]) }}"  class="card-link"><img src="{{ asset('front/img/01.png')}}"> <span>{{ $section->name }}</span></a>
      </div>
       
      </div>
      @endforeach
        
      </div>
    </div>
  </div>
</div>
<!--end section-->
<!--reate-->
<div class="reate">
  <div class="container">
    <h2>الاعلي تقيما</h2>
    <div class="row">
    @foreach($providers as $provider)
      <div class="col-sm-12">
      <a href="{{ route('front.provider' , ['id' => $provider->id]) }}" style="color:#000;">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$provider->image_i) }}">
        <div class="cot">
        <h3>{{ $provider->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $provider->address }}</p>
        </div>
        <div class="ret"> <img src="{{ asset('front/img/star(-1.png')}}"><span>{{ $provider->reats }}</span></div>
      </div>
      </a>
      </div>
      @endforeach

      
    </div>
  </div>
</div>
<!--end reate-->

<!--nav-->
<div class="nav">
  <div class="container">
    <div class="row">
      <div class="col"><a class="nav-link" href="{{ route('home') }}">  <i class="fa fa-home"></i>الرائيسية </a></div>
      <div class="col"><a class="nav-link " href="{{ route('new') }}"><i class="fa fa-list"></i>طلباتي </a></div>
      <div class="col"><a class="nav-link" href="{{ route('orders') }}"><i class="fa fa-bookmark"></i>العروض</a></div>
    </div>
  </div>
</div>


<!--nav-->

@endsection
@section('scripts')
<script>
        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("BCpMWb6V4rrtPtwf2D3LysRsfvSkJTJ8yQKenb3gpM7GL_nJM3SL8xTulisGE4sPzVdHwuRB-n7fG9-zml7kAiw");

        function sendTokenToServer(token) {
            console.log('token retrived', token);
            const user_id = '{{Auth::user()->id}}';
            axios.post('{{ route("save.token") }}',{
                token, user_id
            }).then(res => {
                console.log(res);
            });
        }
        function retriveToken() {
          messaging.getToken({vapidKey: "BCpMWb6V4rrtPtwf2D3LysRsfvSkJTJ8yQKenb3gpM7GL_nJM3SL8xTulisGE4sPzVdHwuRB-n7fG9-zml7kAiw"}).then((currentToken) => {
                if (currentToken) {
                    sendTokenToServer(currentToken);
                    // updateUIForPushEnabled(currentToken);
                } else {
                    alert('you should allow notifications');
                }
            });
        }
        retriveToken();
       

    </script>
@endsection
