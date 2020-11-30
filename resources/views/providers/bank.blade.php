@extends('layouts.app')





@section('content')
<div class="order">
  <div class="container">
    <div class="header">
      <h1> <i class="fa fa-th-large"> </i><span>البنوك</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
    </div>
  </div>

  <!--ord-->
  <div class="ord">
      <div class="container">

  <h3>البنوك</h3> 
  
   <div class="row">
  

   @foreach($banks as $Bank)
       <div class="col-sm-12">
       <a href="{{ route('front.banks' , ['id' => $Bank->id]) }}" style="color:#000; text-decoration:none;">
       <div class="coun">
        <div class="cou">
        <h3>{{ $Bank->name }}</h3> 
        <div class="row">
          <div class="col">
            <span>رقم الحساب</span>
            <p>{{ $Bank->num }}</p>
          </div>
          <div class="col">
            <span>رقم الحساب</span>
            <p>{{ $Bank->ipan }}</p>
          </div>
        </div>
        </div>
      </div></a>
      
      </div>
      @endforeach
     
  
  </div>  

   
                  
      </div>

      
</div>
@endsection
