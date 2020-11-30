@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>تسجيل دخول</h2> 


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                        @csrf

                        <div class="form-group">
          <label for="exampleInputemail">البريد الالكتروني</label>
          <input type="email" name="email" value="{{ old('email') }}"  class="form-control" id="exampleInputemail" placeholder="الرجاء ادخال رقم الجوال">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">كلمة المرور</label>
          <input id="password-field" type="password" class="form-control" name="password" required placeholder="الرجاء ادخال كلمة المرور">
              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <button type="submit" class="btn">تسجيل دخول <i class="fa fa-arrow-left"></i></button>
      </form>

  </div>
</div>
@endsection