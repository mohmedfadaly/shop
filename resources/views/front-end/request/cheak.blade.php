@extends('layouts.app')





@section('content')
<div class="order">
  <div class="container">
    <div class="header">
      <h1> <i class="fa fa-th-large"> </i><span>الفاتورة</span></h1>
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
      
  <h3>الفاتورة</h3> 
  
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

        <form class="contact100-form validate-form"action="{{ route('cheak.update', $Req->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        <input type="hidden"  value="{{ $Req->Servs()->sum('salary')* 0.05 }}" id="tax" name="tax">
                         <input type="hidden"  value="{{ $Req->Servs()->sum('salary') }} " id="Total" name="Total">
                         <button type="submit" class="btn btn-primary">تاكيد الحجز</button>
                </form>
       
        </div> 
      </div>
      </div>

  </div>

 


</div>
@endsection




