@extends('layouts.app')





@section('content')
<div class="reating">
  <div class="container">
    <div class="row">
    <div class="col-sm-12">
    <div class="image">
            <img src="{{ asset('front/img/undraw_online_dating_yruf.png')}}">
    </div>
    <div class="col-sm-12">
      <div class="count">
      <img src="{{ url('uploads/ii/'.$provider->image_i) }}">
        <div class="cot">
        <h3>{{ $provider->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $provider->address }}</p>
        </div>
        <div class="ret"> <img src="{{ asset('front/img/star(-1.png')}}"><span>{{ $provider->reats }}</span></div>
      </div>
      </div>

    </div>
      
    </div>


    <!-- Rating Stars Box -->
  <div class='rating-stars text-center'>
    <ul id='stars'>
      <li class='star' title='Poor' data-value='1'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Fair' data-value='2'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Good' data-value='3'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='Excellent' data-value='4'>
        <i class='fa fa-star fa-fw'></i>
      </li>
      <li class='star' title='WOW!!!' data-value='5'>
        <i class='fa fa-star fa-fw'></i>
      </li>
    </ul>
  </div>
  
   <div class='success-box'>
    <div class='clearfix'></div>
    
    <div class='text-message'></div>
    <div class='clearfix'></div>
  </div>
  <form class="contact100-form validate-form"action="{{ route('reate.store', $provider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        @method('PUT')  
                        <input type="hidden"  value="{{ $provider->id }}" id="prov_id" name="prov_id">
                         <input type="hidden"  value="" id="reat" name="reat">
                         <button type="submit" class="btn btn-primary">ارسال التقيم</button>
                         
                         
                </form>
  </div>
</div>
@endsection
