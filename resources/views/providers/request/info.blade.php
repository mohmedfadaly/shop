@extends('layouts.app')





@section('content')
<div class="order">
  <div class="container">
    <div class="header">
      <h1> <i class="fa fa-th-large"> </i><span>الطلبات الحالية</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
    </div>
  </div>

  <!--ord-->
  <div class="ord">
      <div class="container">
      
            <!--rate-->
  @foreach($Req as $Req)
  <div class="row">
      <div class="col-sm-12">
      <div class="count">
        <img src="{{ url('uploads/ii/'.$Req->Prov->image_i) }}">
        <div class="cot">
        <h3>{{ $Req->Prov->name }}</h3> 
        <p> <i class="fa fa-map-marker"></i>{{ $Req->Prov->address }}</p>
        </div>
        <div class="num"><p>رقم الطلب</p><p>{{ $Req->id }}</p></div>
        </div>
      </div>

      @endforeach
  </div> 
  <h3>تفاصيل الطلب</h3>     
  <div class="row">
   @foreach($Serv as $Serv)
   @if(in_array($Serv->id, $Servs))
   
      <div class="col-sm-12">
      <div class="coun">
        <div class="cou">
        <h3>{{ $Serv->name }}</h3> 
        <del>{{ $Serv->osalary }} ريال</del>
        <span>{{ $Serv->salary }} ريال</span>
        </div>
      </div>
      </div>
      
      @endif
      @endforeach
  </div>  

   
                  
      </div>

      <div class="way">
      <div class="container">
        <div class="row">
        <div class="col-sm-12">
        <div class="mon">
          <h2>طريقة الدفع</h2>
          <p><i class="fa fa-money"></i> دفع عند الاستلام</p>
        </div> 
        </div>

        <div class="col-sm-12">
        <div class="mon">
          <h2>العنوان</h2>
          <p> <i class="fa fa-map-marker"></i>{{ $Req->address }}  <a href="#" class="card-link">(مشاهدة الموقع)</a></p>
        </div> 
        </div>
        <hr>
     
        </div>
        <div class="res">
          <div class="row">
            <div class="col">
              <h3> الضريبة المضافة <span>%5</span></h3>
            </div>
            <div class="col">
              <h4> {{ $Req->Servs()->sum('salary')* 0.05 }} ريال</h4>
            </div>
          </div>
        </div>

        <div class="max">
          <div class="row">
            <div class="col">
              <h3> الاجمالي</h3>
            </div>
            <div class="col">
            
              <h4> {{ $Req->Servs()->sum('salary') }} ريال</h4>
            </div>
          </div>
          <hr>  
        </div>
        
        <hr>


        <h3>ملاحظات</h3>
        <div class="row">
          <div class="col-sm-12">
            <div class="det">
              <p>هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل  هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل هذا النص يمكن ان يستبدل</p>

            </div>

          </div>
         
        </div> 
        @if($Req->state == '0')
          <div class="row">
          <div class="col">
          <a class="btn btn-primary" href="{{ route('sucs' , ['id' => $Req->id]) }}" role="button">قبول الطلب</a>
          </div>
          <div class="col">
          <a class="btn btn-primary" href="{{ route('dis' , ['id' => $Req->id]) }}" role="button">رفض الطلب</a>
          </div>
          </div>
          @endif

          @if($Req->state == '2'|| $Req->state == '3' || $Req->state == '4')
          <a class="btn btn-primary" href="{{ route('flow.prov' , ['id' => $Req->id]) }}" role="button">متابعة الطلب</a>
          @endif
      </div>
      </div>

  </div>

 



<!--nav-->
<div class="nav">
  <div class="container">
    <div class="row">
    <div class="col"><a class="nav-link" href="{{ route('start') }}">  <i class="fa fa-home"></i>الرائيسية </a></div>
      <div class="col"><a class="nav-link " href="{{ route('pnew') }}"><i class="fa fa-list"></i>طلباتي </a></div>
      <div class="col"><a class="nav-link" href="{{ route('wallet') }}"><i class="fa fa-briefcase"></i>المحفظة</a></div>
    </div>
  </div>
</div>


<!--nav-->
</div>
@endsection
