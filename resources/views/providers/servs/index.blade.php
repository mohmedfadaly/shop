@extends('layouts.app')
@section('content')
<div class="notf">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>الخدمات</span></h1>
            <a href="javascript:void(0);" class="menu_icon"></a>
            <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
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
 <!--ord-->
 <div class="order">
 <div class="ord">
      <div class="container">
      @foreach($servs as $Serv)
   <div class="row">
      <div class="col-sm-12">
      <div class="coun">
        <div class="cou">
        <h3>{{ $Serv->name }}</h3> 
        <del>{{ $Serv->osalary }}ريال</del>
        <span>{{ $Serv->salary }} ريال</span>
        </div>
        <div class="control">
        <a  class="nav-link" href="{{ route('servs.edit' , ['id' => $Serv]) }}"><i class="fa fa-edit"> </i></a>
         <form action="{{route('servs.destroy', ['id' => $Serv->id])}}" method="POST"style="display: block;">
         @csrf
                                  @method('DELETE')           
        <button type="submit" rel="tooltip" title="" class="btn btn-danger btn-customized-2" data-original-title="delete">
        <i class="fa fa-trash"> </i>
        </button>

        </form>
        
        </div>
      </div>

      </div>


      
  
  </div>  

      @endforeach
                  
      

          <a class="btn btn-primary" href="{{ route('servs.create') }}" role="button">اضافة خدمة</a>

      </div>

  </div>
  </div>

@endsection
