@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>استعادة كلمة المرور <i class="fa fa-arrow-left"></i></h2> 

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                                <button type="submit"  class="btn">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                         
                    </form>
                    <p>لديك حساب باالفعل ؟ <a href="#"  class="card-link">اضغط هنا</a></p>

</div>
</div>
@endsection
