@extends('layouts.app')





@section('content')
<div class="notf">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>الاشعارات</span></h1>
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
  <div class="notfy">
    <div class="container">
    <div style="background-color: #305085;
    color: #fff;
    font-family: hanimation-regular;
    text-align: center;
    margin-bottom: 40px;
    margin-top: 60px;
    padding: 12px 35px;
    width: 20%;
    border-radius: 15px;
    font-size: 28px;">
        <form action="{{route('anots.destroy')}}" method="POST">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title=""  style="background: transparent; border: none; color: #fff;" data-original-title="delete">
                                  مسح الكل
                                  </button>

                              </form>
          </div>

      <div class="row">
         
      @foreach($Nots as $Not)
        <div class="col-sm-12">
        <div class="count">
          <img src="{{ url('uploads/ii/'.$Not->Prov->image_i) }}">
          <div class="cot">
          <h3>{{ $Not->Prov->name }}</h3> <span>{{ $Not->created_at }}</span>
          <p>{{ $Not->nots }}</p>
          </div>
          
        </div>
        <div class="del">
        <form action="{{route('nots.destroy', ['id' => $Not->id])}}" method="POST">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title="" style="background: transparent; border: none; color: #fff;" data-original-title="delete">
                                  <i class="fa fa-times"></i>
                                  </button>

                              </form>
          </div>
        </div>
        @endforeach
    </div>
    </div>
    
  </div>


</div>
@endsection
