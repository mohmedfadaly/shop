@extends('layouts.app')

@section('content')
<div class="login">
  <div class="container">
  <img src="{{ asset('front/img/1.png')}}" class="rounded mx-auto d-block">
    <h1>SERVICES <span> APP</span> </h1>
    <h2>استعادة كلمة المرور <i class="fa fa-arrow-left"></i></h2> 


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('prov.password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                        
                    </form>
                    <p>لديك حساب باالفعل ؟ <a href="#"  class="card-link">اضغط هنا</a></p>

</div>
</div>
@endsection
