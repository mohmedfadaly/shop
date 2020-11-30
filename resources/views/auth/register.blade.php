@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>انشاء حساب</h2>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden"  value="" id="latitude" name="latitude">
                        <input type="hidden" value="" id="longitude"  name="longitude">
                        <div class="form-group">
          <label for="exampleInputphone">اسم المستخدم</label>
          <input type="text"  name="name" class="form-control" id="exampleInputphone" placeholder="الرجاء ادخال اسم المستخدم">
          @error('name')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputphone">رقم الجوال</label>
          <input type="phone" name="phone" class="form-control" id="exampleInputphone" placeholder="الرجاء ادخال رقم الجوال">
          @error('phone')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputphone">البريد الالكتروني</label>
          <input type="email" name="email" class="form-control" id="exampleInputphone" placeholder="الرجاء ادخال البريد الالكتروني">
          @error('email')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
        </div>

        <div class="form-group">
          <label for="exampleInputphone">اختر المدينة</label>
          <input type="text" id="pac-input" class="form-control" placeholder="  " name="address">
          <btn onclick="$('#profileCard').slideToggle(1000)" class=" btn-outline-default btn-round field-icon"><i class="fa fa-map-marker"></i></btn>
        </div>

<div class="card text-left" id="profileCard" style="display: none">
<div class="validate-input" id="map" style="min-height: 300px;min-width: 250px;"></div>
</div>

<div class="form-group">
                    <label for="exampleInputEmail1">الصورة الشخصية</label>
                    <input type="file" class="form-control" name="image" >
                    @error('image')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
                    </div>
                  


                    <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور</label>
          <input id="password-field" type="password" class="form-control" name="password" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>

        <div class="form-group">
          <label for="exampleInputPassword1">تاكيد كلمة المرور</label>
          <input id="password-confirm password-field" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="الرجاء تاكيد كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="radio">
          <label class="form-check-label" for="exampleCheck1"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">موافق علي الشروط والاحكم</button></label>
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">الشروط والاحكام</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="list">
    <ul>
      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل
        هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص</p>
      </li>

      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل  يمكن ان يستبدل</p>
      </li>
      <li>
        <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل</p>
      </li>
    </ul>
 
</div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>


        <button type="submit" id="nxtBtn" class="btn">انشاء حساب</button>
      </form>
      <p>لديك حساب باالفعل ؟ <a href="{{ route('login') }}"  class="card-link">اضغط هنا</a></p>

  </div>
</div>



@endsection

@section('script')
<script>

$(document).ready(function(){
 $('#nxtBtn').hide(); 
 $('#radio').mouseup(function () {
    $('#nxtBtn').toggle();
 });
});

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

