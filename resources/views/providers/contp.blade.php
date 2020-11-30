@extends('layouts.app')





@section('content')
<div class="contact">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>اتصل بنا</span></h1>
            <a href="#"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
  </div>
   <div class="agree">
  <div class="container">
    <div class="blur">
      <div class="image"><img src="img/undraw_mobile_interface_wakp.png"></div>
    </div>
  </div>
  </div>
  <div class="mass">
    <div class="container">
    <form role="form" class="contact100-form validate-form" action="{{ route('pmasg.store') }}" method="POST">
            @csrf 
      <div class="form-group">
    <label for="exampleFormControlTextarea1">الرسالة</label>
    <textarea name="masg" class="form-control" id="exampleFormControlTextarea1" placeholder="اكتب الرسالة هنا"></textarea>
    </div>
     <button type="submit" class="btn">ارسال</button>
    </form>
    </div>


    <div class="footer text-center">
    <div class="container">
      <h2>او عبر مواقع التواصل الاجتماعية</h2>

      <div class="social">
        <div class="row">
          <div class="col">
            <div class="ico_b"><a href="#"  class="card-link"><i class="fa fa-bell"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_t"><a href="#"  class="card-link"><i class="fa fa-twitter"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_i"><a href="#"  class="card-link"><i class="fa fa-instagram"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_w"><a href="#"  class="card-link"><i class="fa fa-whatsapp"></i></a></div>
          </div>

          <div class="col">
            <div class="ico_g"><a href="#"  class="card-link"><i class="fa fa-telegram"></i></a></div>
          </div>
        </div>
      </div>
      </div>
     </div>

    
  </div>

  

  

</div>
@endsection
