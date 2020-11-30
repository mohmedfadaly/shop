@extends('layouts.app')

@section('title' , $provider->name)



@section('content')
<div class="infor">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col-sm-12">
      <h1> <i class="fa fa-th-large"> </i><span>نوع الخدمة</span></h1>
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
<form class="contact100-form validate-form" action="{{ route('front.reqstore')}}" method="POST">
@csrf
       
<div class="kind">
<div class="ord">
      <div class="container">
      <h2>اختر نوع الحجز</h2>
      <div class="act">
      <div class="row">

      <div class="col"><a class="btn btn-primary" href="{{ route('reqsin.create', ['id' => $provider]) }}" role="button">حجز بالمشغل </a></div>
        <div class="col"><a class="btn btn-primary" href="{{ route('reqsout.create', ['id' => $provider]) }}" role="button"> حجز منزلي</a></div>
      </div>
      </div>

      <div class="chack">
        
        <h2>اختر نوع الخدمة</h2>

        <input type="hidden"  value="{{$provider->id}}" id="pro_id" name="pro_id">
        <input type="hidden"  value=" {{auth()->user()->name}} لقد  تم تقديم طلب لك من" id="nots" name="nots">
        <input type="hidden"  value="prov" id="kind" name="kind">
        
        <input type="hidden"  value="{{$provider->id}}" id="prov_id" name="prov_id">
        <input type="hidden"  value="1" id="active" name="active">
        <input type="hidden"  value="0" id="state" name="state">
        <input type="hidden"  value="0" id="Total" name="Total">
        
        <input type="hidden"  value="0" id="tax" name="tax">
        <input type="hidden"  value="" id="latitude" name="latitude">
        <input type="hidden" value="" id="longitude"  name="longitude">
        @foreach($Serv as $Serv)
        <div class="spec">
          
          <label class="customcheck">
        <h3>{{ $Serv->name }}</h3>
        <p>{{ $Serv->salary }}ريال</p>
          <input value="{{ $Serv->id }}" name="serv[]" type="checkbox">
          <span class="checkmark"></span>
        </label>
        </div>
        @endforeach
        
      </div>
  
</div>
</div>
<div class="inp">
    
       

      <div class="container">
      <h2>بيانات الحجز</h2> 
        <div class="form-group">
          <label for="exampleInputname">كتابة الاسم</label>
           <input type="text" class="form-control" id="exampleInputphone" name="name" placeholder="الرجاء ادخال الاسم">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">كتابة رقم الجوال</label>
          <input type="phone" class="form-control" id="exampleInputphone" name="phone" placeholder="الرجاء ادخال رقم الجوال">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">اختر المدينة</label>
          <input type="text" id="pac-input" class="form-control" placeholder="  " name="address">
          <btn onclick="$('#profileCard').slideToggle(1000)" class=" btn-outline-default btn-round field-icon"><i class="fa fa-map-marker"></i></btn>
        </div>

          <div class="card text-left" id="profileCard" style="display: none">
          <div class="validate-input" id="map" style="min-height: 300px;min-width: 250px;"></div>
          </div>
          </div>
      </div>
      <div class="des">
        <div class="container">
        <h2>تحديد الوقت</h2> 
          <div class="row">
            <div class="col">
                <div class="form-group">
                  <label for="exampleInputphone">من</label>
                   <input type="time" name="time_from" class="form-control" id="exampleInputphone" placeholder="من">
               </div>
            </div>

            <div class="col">
                <div class="form-group">
                  <label for="exampleInputphone">الي</label>
                  <input type="time" name="time_to" class="form-control" id="exampleInputphone" placeholder="الي">
               </div>
            </div>
              

          </div>
                    
                <div class="form-group">
                  <label for="exampleInputphone">تحديد التاريخ</label>
                  <input type="date" name="date" class="form-control" id="exampleInputphone" placeholder="التاريخ">
               </div>
                    
    

          <div class="form-group">
          <label for="exampleFormControlTextarea1">ملاحظات</label>
          <textarea class="form-control" name="des" id="exampleFormControlTextarea1" placeholder="اكتب ملاحظاتك هنا"></textarea>
          </div>
          
     <button type="submit" class="btn">حجز الان</button>
        </div>
      </div>
      
    
</div>
</form>
</div>


      
@endsection

@section('script')
<script>



$("#pac-input").focusin(function() {
  $(this).val('');
});

$('#latitude').val('');
$('#longitude').val('');


// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 24.740691, lng: 46.6528521 },
    zoom: 13,
    mapTypeId: 'roadmap'
  });

  // move pin and current location
  infoWindow = new google.maps.InfoWindow;
  geocoder = new google.maps.Geocoder();
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map.setCenter(pos);
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(pos),
        map: map,
        title: 'موقعك الحالي'
      });
      markers.push(marker);
      marker.addListener('click', function() {
        geocodeLatLng(geocoder, map, infoWindow,marker);
      });
      // to get current position address on load
      google.maps.event.trigger(marker, 'click');
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    console.log('dsdsdsdsddsd');
    handleLocationError(false, infoWindow, map.getCenter());
  }

  var geocoder = new google.maps.Geocoder();
  google.maps.event.addListener(map, 'click', function(event) {
    SelectedLatLng = event.latLng;
    geocoder.geocode({
      'latLng': event.latLng
    }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          deleteMarkers();
          addMarkerRunTime(event.latLng);
          SelectedLocation = results[0].formatted_address;
          console.log( results[0].formatted_address);
          splitLatLng(String(event.latLng));
          $("#pac-input").val(results[0].formatted_address);
        }
      }
    });
  });
  function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
    var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
    /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
    $('#latitude').val(markerCurrent.position.lat());
    $('#longitude').val(markerCurrent.position.lng());

    geocoder.geocode({'location': latlng}, function(results, status) {
      if (status === 'OK') {
        if (results[0]) {
          map.setZoom(8);
          var marker = new google.maps.Marker({
            position: latlng,
            map: map
          });
          markers.push(marker);
          infowindow.setContent(results[0].formatted_address);
          SelectedLocation = results[0].formatted_address;
          $("#pac-input").val(results[0].formatted_address);

          infowindow.open(map, marker);
        } else {
          window.alert('No results found');
        }
      } else {
        window.alert('Geocoder failed due to: ' + status);
      }
    });
    SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
  }
  function addMarkerRunTime(location) {
    var marker = new google.maps.Marker({
      position: location,
      map: map
    });
    markers.push(marker);
  }
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }
  function clearMarkers() {
    setMapOnAll(null);
  }
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  $("#pac-input").val("أبحث هنا ");
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      if (!place.geometry) {
        console.log("Returned place contains no geometry");
        return;
      }
      var icon = {
        url: place.icon,
        size: new google.maps.Size(100, 100),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));


      $('#latitude').val(place.geometry.location.lat());
      $('#longitude').val(place.geometry.location.lng());

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
    'Error: The Geolocation service failed.' :
    'Error: Your browser doesn\'t support geolocation.');
  infoWindow.open(map);
}
function splitLatLng(latLng){
  var newString = latLng.substring(0, latLng.length-1);
  var newString2 = newString.substring(1);
  var trainindIdArray = newString2.split(',');
  var lat = trainindIdArray[0];
  var Lng  = trainindIdArray[1];

  $("#latitude").val(lat);
  $("#longitude").val(Lng);
}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv2cGCkk7fn1CKKhqX6vA_VTF4UdnyLJ0&libraries=places&callback=initAutocomplete&language=ar&region=EG
         async defer"></script>


         @stop


