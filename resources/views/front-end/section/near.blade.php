@extends('layouts.app')

@section('title' , $section->name)



@section('content')
<div class="felt">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col-sm-12">
      <h1> <i class="fa fa-th-large"> </i><span>{{ $section->name }}</span></h1>
      <a href="javascript:void(0);" class="menu_icon"></a>
      <a   class="card-link" href="{{ route('nots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
       <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
    </div>
    <div class="col-sm-12 ser">
       <form class="form-group">
        <input class="form-control" type="search" placeholder="ابحث هنا" aria-label="Search">
        
        <i class="fa fa-search"></i>
       </form>

<nav>
      <ul>
       <li class="fil menu" id="dropMenu">
          <div class="drop-box">
        <i class="fa fa-sliders"></i>
          </div>
          <ul id="ul">
            <li class="homes"><a class="card-link" href="{{ route('near.section' , ['id' => $section->id] ) }}">الاقرب</a></li>
            <li class="homes"><a class="card-link" href="{{ route('top.section' , ['id' => $section->id] ) }}">الاعلي تقيم</a></li>
            <li class="homes"><a class="card-link" href="{{ route('bottom.section' , ['id' => $section->id] ) }}">الاقل تقيم</a></li>
           
          </ul>
        </li>

      </ul>
 </nav>
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
<!--reate-->
<div class="reat">
  <div class="container">
  <div class="header">
    
    <h2>من فضلك اختار بيوتي سنتر</h2>
    <div class="ico" id="myTab">
      <a   class="card-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"><i class="fa fa-list"></i></a>
      <a   class="card-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"><i class="fa fa-map-marker"></i></a>
    </div>
  </div>
    
    <div class="row tab-pane" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    @foreach($providers as $provider)
      <div class="col-sm-12">
      <a href="#" style="color:#000;">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$provider->image_i) }}">
        <div class="cot">
        <h3>{{ $provider->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $provider->address }}</p>
        </div>
        <div class="ret"> <img src="{{ asset('front/img/star(-1.png')}}"><span>{{ $provider->reats }}</span></div>
      </div>
      </div>
      </a>
      @endforeach

      
    </div>

    <div class="row tab-pane" style="display:none;" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <div class="col-sm-12">
      <div id="mymap" style="min-height: 600px;min-width: 100%; margin-bottom:100px;"></div>
      </div>

      
    </div>
  </div>
</div>
<!--end reate-->


</div>
@endsection
@section('script')
<script type="text/javascript">

$('#pills-home-tab').on('click', function (e) {
  e.preventDefault()
  $("#pills-home").css("display","block");
  $("#pills-profile").css("display","none");
})

$('#pills-profile-tab').on('click', function (e) {
  e.preventDefault()
  $("#pills-profile").css("display","block");
  $("#pills-home").css("display","none");
})



var providers = <?php print_r(json_encode($providers)) ?>;


var mymap = new GMaps({
  el: '#mymap',
  lat: {{Auth::user()->latitude}},
  lng: {{Auth::user()->longitude}},
  zoom:13
});


$.each( providers, function( index, value ){
  var myIcon = 'http://ruralshores.com/assets/marker-icon.png';
  var url = '{{ url("uploads/ii/"."%id%") }}';
  url = url.replace('%id%', value.image_i);
    mymap.addMarker({
      lat: value.latitude,
      lng: value.longitude,
      title: value.name,
      icon: myIcon,
      infoWindow: {
          content: "<div style='float:right; padding: 10px;'> <img src='"+url+"'><a href='#'>"+value.name +"</a><br/></div>"
        }
    });
    

    
});


</script>

    @stop
