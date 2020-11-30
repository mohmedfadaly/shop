@extends('back_end.layout.app')
@section('title')
تعديل
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
                <h3 class="card-title">تعديل بنك</h3>
              </div>
			<form role="form" class="contact100-form validate-form"action="{{ route('trans.update' , ['id' => $Trans]) }}" method="POST"> 
            @csrf
            @method('PUT')  
            <input type="hidden"  value="1" id="state" name="state">
            <input type="hidden"  value="{{$Trans->Prov->wallet}}" id="wallet" name="wallet">
			<div class="card-body">
				
                  
                  <div class="form-group">
                    <label for="exampleInputname">المبلغ المدفوع</label>
                    <input type="text" readonly  value="{{$Trans->cash}}" class="form-control" id="exampleInputphone" name="cash" placeholder="الرجاء ادخال المبلغ">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputphone">البنك</label>
                    <input type="text" readonly value="{{$Trans->bank}}" class="form-control" id="exampleInputphone" name="bank" placeholder="الرجاء ادخال اسم البنك">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputphone">اسم صاحب الحساب</label>
                    <input type="phone" readonly  value="{{$Trans->name}}" class="form-control" id="exampleInputphone" name="name" placeholder="الرجاء ادخال الاسم">
                  
                  </div>
                  <div class="form-group">
                  <label for="exampleInputphone"> صورة الوصل
                  <img src="{{ url('uploads/p/'.$Trans->image) }}" width="400">
                  </label>
               </div>

        <div class="form-group">
          <label for="exampleInputphone">اسم رقم الحساب</label>
          <input type="phone" readonly  value="{{$Trans->num}}" class="form-control" id="exampleInputphone" name="num" placeholder="الرجاء ادخال الرقم">
         
        </div>
        @if($Trans->state == '0')
				  <div class="card-footer">
          
				  <button type="submit" class="btn btn-primary">	<i class="fas fa-check"></i><span>  موافقة </span>

					</button>
          
				</div>
        @endif
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