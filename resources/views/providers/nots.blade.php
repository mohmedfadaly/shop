@extends('layouts.app')





@section('content')
<div class="notf">
  <div class="container">
    <div class="half">
        <div class="header">
            <h1><span>الاشعارات</span></h1>
            <a href="#"><i class="fa fa-arrow-left"></i></a>
        </div>
    </div>
  </div>
  <div class="notfy">
    <div class="container">
    <div style="background-color: #305085;
    color: #fff;
    font-family: hanimation-regular;
    text-align: center;
    margin-bottom: 40px;
    margin-top: 60px;
    padding: 12px 35px;
    width: 20%;
    border-radius: 15px;
    font-size: 28px;">
        <form action="{{route('panots.destroy')}}" method="POST">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title=""  style="background: transparent; border: none; color: #fff;" data-original-title="delete">
                                  مسح الكل
                                  </button>

                              </form>
          </div>

      <div class="row">
         
      @foreach($Nots as $Not)
        <div class="col-sm-12">
        <div class="count">
          <img src="{{ url('uploads/user/'.$Not->user->image) }}">
          <div class="cot">
          <h3>{{ $Not->user->name }}</h3> <span>{{ $Not->created_at }}</span>
          <p>{{ $Not->nots }}</p>
          </div>
          
        </div>
        <div class="del">
        <form action="{{route('pnots.destroy', ['id' => $Not->id])}}" method="POST">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title="" style="background: transparent; border: none; color: #fff;" data-original-title="delete">
                                  <i class="fa fa-times"></i>
                                  </button>

                              </form>
          </div>
        </div>
        @endforeach
    </div>
    </div>
    
  </div>


</div>
@endsection
