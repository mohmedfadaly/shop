@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="img/1.png" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>استعادة كلمة المرور <i class="fa fa-arrow-left"></i></h2> 

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                    <p>لديك حساب باالفعل ؟ <a href="#"  class="card-link">اضغط هنا</a></p>

</div>
</div>
@endsection
