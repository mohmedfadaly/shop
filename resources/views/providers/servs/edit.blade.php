@extends('layouts.app')
@section('content')
<div class="notf">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>تعديل خدمة</span></h1>
            <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
  </div>
</div>

<div class="login">
<div class="container">
<form role="form" class="contact100-form validate-form" action="{{ route('servs.update' , ['id' => $Serv]) }}" method="POST">
            @csrf 
            @method('PUT')
      <div class="form-group">
        <div class="form-group">
          <label for="exampleInputname">اسم الخدمة</label>
          <input type="text" name="name" value="{{$Serv->name}}" class="form-control" id="exampleInputname" placeholder="الرجاء ادخل اسم الخدمة">
        </div>

        <div class="form-group">
          <label for="exampleInputname">السعر قبل الخصم</label>
          <input type="number" name="osalary" value="{{$Serv->osalary}}" class="form-control" id="exampleInputname" placeholder="الرجاء ادخل السعر ">
        </div>

        <div class="form-group">
          <label for="exampleInputname">السعر بعد الخصم</label>
          <input type="number" name="salary" value="{{$Serv->salary}}" class="form-control" id="exampleInputname" placeholder="الرجاء ادخل اسم السعر">
        </div>
        
        <button type="submit" class="btn">انشاء</button>
      </form>

  </div>
</div>



@endsection
