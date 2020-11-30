@extends('layouts.app')
@section('content')
<div class="home">
  <div class="container">
    <div class="header">
    <a href="javascript:void(0);" class="menu_icon"></a>
      
      <h1> <i class="fa fa-th-large"> </i><span>الرائيسية</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
    </div>
  </div>
<div id="menu">
<div class="ime">
  
  <img src="{{ url('uploads/ii/'.Auth::guard('prov')->user()->image_i) }}" alt="...">
  <div class="write">
  <h2>{{ Auth::guard('prov')->user()->name }}</h2>
  <p>{{ Auth::guard('prov')->user()->email }}</p>
  </div>
</div>


        <ul>
        
                            
                        
    <li><a href="{{ route('start') }}"><i class="fa fa-home"></i><span>الرائيسية</span></a></li>
    <li><a href="{{ route('prov.profile', ['id' => Auth::guard('prov')->user()->id]) }}"><i class="fa fa-user"></i><span>الملف الشخصي</span></a></li>
    <li><a href="{{ route('pnots') }}"><i class="fa fa-bell"></i><span>الاشعارات</span></a></li>
    <li><a href="{{ route('servs.index') }}"><i class="fa fa-edit"></i><span>تعديل الخدمات</span></a></li>
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
<div class="order">

  <!--ord-->
  <div class="ord">
      <div class="container">
     
            <!--rate-->
  <div class="row">
  @foreach($Req as $Req)
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
      </div>
      </a>
      </div>


  </div> 
  

  @endforeach

  </div> 

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

@endsection
@section('scriptss')
<script>
        const messaging = firebase.messaging();
        messaging.usePublicVapidKey("BCpMWb6V4rrtPtwf2D3LysRsfvSkJTJ8yQKenb3gpM7GL_nJM3SL8xTulisGE4sPzVdHwuRB-n7fG9-zml7kAiw");

        function sendTokenToServer(token) {
            console.log('token retrived', token);
            const Prov_id = '{{Auth::guard("prov")->user()->id}}';
            axios.post('{{ route("save.ptoken") }}',{
                token, Prov_id
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