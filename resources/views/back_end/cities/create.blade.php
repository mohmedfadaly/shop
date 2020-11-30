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
                <h3 class="card-title">اضافة مدينة</h3>
              </div>
			<form role="form" class="contact100-form validate-form" action="{{ route('cities.store') }}" method="POST">
            @csrf 
			<div class="card-body">
				<div class="form-group">
                    <label for="exampleInputEmail1">الاسم</label>
                    <input class="form-control" id="exampleInputEmail1" type="text" name="name" placeholder="الاسم">
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