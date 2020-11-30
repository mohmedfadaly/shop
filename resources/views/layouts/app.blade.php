<!doctype html>
<html>

<head>
<meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/media.css')}}">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-messaging.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyCWDxE_1G1O83WmefJ4YX8OgUhvmHbJoPg",
    authDomain: "test-199ee.firebaseapp.com",
    databaseURL: "https://test-199ee.firebaseio.com",
    projectId: "test-199ee",
    storageBucket: "test-199ee.appspot.com",
    messagingSenderId: "872658105725",
    appId: "1:872658105725:web:5fc0aa2c0f58777190c814",
    measurementId: "G-JD9PSN8J57"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

  
</head>
<body>


@yield('content')





        

<script src="{{ asset('front/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{ asset('front/js/bootstrap.min.js')}}"></script>  
<script src="{{ asset('front/js/popper.min.js')}}"></script>
<script src="{{ asset('front/js/gmaps.min.js')}}"></script>
<script src="{{ asset('front/js/custom.js')}}"></script> 


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCv2cGCkk7fn1CKKhqX6vA_VTF4UdnyLJ0&libraries=places&callback=initAutocomplete&language=ar&region=EG
         async defer"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  
@yield('script')  

@yield('scripts')

@yield('scriptss')
</body>
</html>