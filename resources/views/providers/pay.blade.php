@extends('layouts.app')





@section('content')
<div class="infor">
  <div class="container">
    <div class="header">
    <div class="row">
    <div class="col-sm-12">
      <h1> <i class="fa fa-th-large"> </i><span>تاكيد التحويل</span></h1>
      <a   class="card-link" href="{{ route('pnots') }}"><img src="{{ asset('front/img/n.png')}}"></a>
       <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
    </div>
    
    </div>
  </div>



</div>

<form class="contact100-form validate-form" action="{{ route('pay.store' , ['id' => $banks->id]) }}" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden"  value="{{$banks->id}}" id="bank_id" name="bank_id">
<input type="hidden"  value="0" id="state" name="state">
<div class="kind">

<div class="inp">
    
       

      <div class="container">
      <h2>بيانات التحويل</h2>
      <h2>بيانات الحجز</h2> 
        <div class="form-group">
          <label for="exampleInputname">المبلغ المدفوع</label>
           <input type="text" class="form-control" id="exampleInputphone" name="cash" placeholder="الرجاء ادخال المبلغ">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">البنك</label>
          <input type="phone" class="form-control" id="exampleInputphone" name="bank" placeholder="الرجاء ادخال اسم البنك">
        </div>
        <div class="form-group">
          <label for="exampleInputphone">اسم صاحب الحساب</label>
          <input type="phone" class="form-control" id="exampleInputphone" name="name" placeholder="الرجاء ادخال الاسم">
         
        </div>

        <div class="form-group">
          <label for="exampleInputphone">اسم رقم الحساب</label>
          <input type="phone" class="form-control" id="exampleInputphone" name="num" placeholder="الرجاء ادخال الرقم">
         
        </div>

          
          </div>
      </div>
      <div class="des">
        <div class="container">
        <h2>اضف صورة الوصل</h2> 
          
                    
                <div class="form-group">
                  <label for="exampleInputphone">اضف صورة الوصل
                  <input type="file" name="image" class="form-control">
                  </label>
               </div>
                    
    

      
          
     <button type="submit" class="btn">ارسال</button>
        </div>
      </div>
      
    
</div>
</form>
</div>
@endsection
