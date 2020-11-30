@extends('back_end.layout.app')
@section('title')
    اضافة
@endsection
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
		<div class="col-md-3"></div>
          <!-- left column -->
          <div class="col-md-9">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">اضافة قسم</h3>
              </div>
			<form role="form" class="contact100-form validate-form" action="{{ route('providers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            <input type="hidden"  value="" id="latitude" name="latitude">
            <input type="hidden" value="" id="longitude"  name="longitude">
            <input type="hidden"  value="0" id="reats" name="reats">
            <input type="hidden"  value="0" id="wallet" name="wallet">
			<div class="card-body">
				<div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="name" placeholder="الاسم">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">رقم الهاتف</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="phone" placeholder="رقم الجوال">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكتروني</label>
                    <input class="form-control" id="exampleInputEmail1" type="email" name="email" placeholder="البريد">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">المدينة</label>
                    <select name="city_id" class="form-control" multiple style="height: 100px;">
                    @foreach($cities  as $City)
                      <option value="{{ $City->id }}" >{{ $City->name }}</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">القسم</label>
                    <select name="sec_id" class="form-control" multiple style="height: 100px;">
                    @foreach($sections  as $Section)
                      <option value="{{ $Section->id }}" >{{ $Section->name }}</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">الصورة الشخصية</label>
                    <input type="file" name="image_i" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">العنوان</label>
                    <input type="text" id="pac-input" class="form-control" placeholder="  " name="address">
                  </div>
                  <div class="validate-input" id="map" style="min-height: 300px;min-width: 250px;"></div>

                  <div class="form-group">
                  <label for="exampleInputEmail1">صور المحل</label>
                        <input type="file" name="images[]" class="form-control" data-show-caption="false" data-show-upload="false" multiple>
				          </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">الرقم السري</label>
                    <input class="form-control" id="exampleInputEmail1" type="password" name="password" placeholder="الرقم السري">
                  </div>
				

				  <div class="card-footer">

				  <button type="submit" class="btn btn-primary">	<i class="fas fa-plus"></i><span>   انشاء </span>

					</button>
				</div>
				</div>
			</form>
		</div>
		</div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

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
