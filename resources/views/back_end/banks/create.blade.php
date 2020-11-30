@extends('back_end.layout.app')
@section('title')
    اضافة
@endsection
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
		<div class="col-md-3"></div>
          <!-- left column -->
          <div class="col-md-9">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">اضافة بنك</h3>
              </div>
			<form role="form" class="contact100-form validate-form" action="{{ route('banks.store') }}" method="POST">
            @csrf 
			<div class="card-body">
				<div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="name" placeholder="الاسم">
                    @error('name')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
                  </div>


                  <div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="num" placeholder="رقم الحساب">
                    @error('num')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="ipan" placeholder="الايبان">
                    @error('ipan')
                        <b align="center" class="form-text text-dark">*{{$message}}*</b>
                        @enderror
                  </div>
				

				  <div class="card-footer">

				  <button type="submit" class="btn btn-primary">	<i class="fas fa-plus"></i><span>   انشاء </span>

					</button>
				</div>
				</div>
			</form>
		</div>
		</div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection