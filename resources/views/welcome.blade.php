@extends('layouts.app')
@section('title' , 'welcome')
@section('content')

<div class="start">
  <div class="container">
    <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>

    <div class="row">
         <div class="col">
           <a class="btn btn-primary" href="{{ route('prov.login') }}" role="button">متجر</a>
         </div>
         <div class="col">
           <a class="btn btn-primary" href="{{ route('login') }}" role="button">عميل</a>
         </div>
       </div>
  </div>
</div>






@endsection
