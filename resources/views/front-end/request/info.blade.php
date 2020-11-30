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
      
            <!--rate-->
  @foreach($Req as $Req)
  <div class="row">
      <div class="col-sm-12">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$Req->Prov->image_i) }}">
        <div class="cot">
        <h3>{{ $Req->Prov->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $Req->Prov->address }}</p>
        </div>
        <div class="num"><p>رقم الطلب</p><p>{{ $Req->id }}</p></div>
        </div>
      </div>

      @endforeach
  </div> 
  <h3>تفاصيل الطلب</h3>     
  <div class="row">
   @foreach($Serv as $Serv)
   @if(in_array($Serv->id, $Servs))
   
      <div class="col-sm-12">
      <div class="coun">
        <div class="cou">
        <h3>{{ $Serv->name }}</h3> 
        <del>{{ $Serv->osalary }} ريال</del>
        <span>{{ $Serv->salary }} ريال</span>
        </div>
      </div>
      </div>
      
      @endif
      @endforeach
  </div>  

   
                  
      </div>

      <div class="way">
      <div class="container">
        <div class="row">
        <div class="col-sm-12">
        <div class="mon">
          <h2>طريقة الدفع</h2>
          <p><i class="fa fa-money"></i> دفع عند الاستلام</p>
        </div> 
        </div>

        <div class="col-sm-12">
        <div class="mon">
          <h2>العنوان</h2>
          <p> <i class="fa fa-map-marker"></i>{{ $Req->address }}  <a href="#" class="card-link">(مشاهدة الموقع)</a></p>
        </div> 
        </div>
        <hr>
     
        </div>
        <div class="res">
          <div class="row">
            <div class="col">
              <h3> الضريبة المضافة <span>%5</span></h3>
            </div>
            <div class="col">
              <h4> {{ $Req->Servs()->sum('salary')* 0.05 }} ريال</h4>
            </div>
          </div>
        </div>

        <div class="max">
          <div class="row">
            <div class="col">
              <h3> الاجمالي</h3>
            </div>
            <div class="col">
            
              <h4> {{ $Req->Servs()->sum('salary') }} ريال</h4>
            </div>
          </div>
          <hr>  
        </div>
        
        <hr>


        <h3>ملاحظات</h3>
        <div class="row">
          <div class="col-sm-12">
            <div class="det">
              <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل</p>

            </div>

          </div>
          <a class="btn btn-primary" href="{{ route('flow.req' , ['id' => $Req->id]) }}" role="button">متابعة الطلب</a>
        </div> 
      </div>
      </div>

  </div>

 



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
