@extends('layouts.app')





@section('content')
<div class="pass">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>تغير كلمة المرور</span></h1>
            <a href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
  </div>
   <div class="agree">
  <div class="container">
    <div class="blur">
      <div class="image"><img src="{{ asset('front/img/undraw_my_password_d6kg(1).png')}}"></div>
    </div>
  </div>
  </div>

  <div class="change">
  <div class="container">
  @if (Session::has('success'))
              <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif
            @if (Session::has('failure'))
              <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
            @endif
  <form action="{{ route('update.pass', $Prov->id) }}" method="post" role="form" class="form-horizontal">

  @csrf
                        @method('PUT') 
  
       <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور الحالية</label>
          <input id="password-field" type="password" class="form-control" name="old" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور الجديدة</label>
          <input id="password-field" type="password" class="form-control" name="password" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">تاكيد كلمةة المرور</label>
          <input id="password-field" type="password" class="form-control" name="password_confirmation" placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
                   <button type="submit" class="btn">حفظ التغيرات</button>
 

      </form>
    </div>
  </div>

</div>
@endsection
