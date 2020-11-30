@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>تسجيل دخول</h2> 

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
          <label for="exampleInputphone">رقم الجوال</label>
          <input type="phone" name="phone" value="{{ old('phone') }}"  class="form-control" id="exampleInputphone" placeholder="الرجاء ادخال رقم الجوال">
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
        <a href="{{ route('password.request') }}" class="card-link">هل نسيت كلمة المرور ؟</a>
        <button type="submit" class="btn">تسجيل دخول <i class="fa fa-arrow-left"></i></button>
                    </form>
                    <p>ليس لديك حساب ؟ <a href="{{ route('register') }}"  class="card-link">اضغط هنا</a></p>

</div>
</div>
@endsection