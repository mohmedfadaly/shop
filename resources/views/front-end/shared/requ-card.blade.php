<div class="expert_doctors_area">
<div class="row">
<div class="col-xl-12">
<div class="expert_active owl-carousel">

@foreach($Request->images as $images)
        <div class="col-lg-4">
        <div class="owl-item active" style="width: 255px; margin-right: 30px;"><div class="single_expert">
                            <div class="expert_thumb">
                            
                                <img src="{{ url('uploads/images/'.$images->images) }}" width="250" height="300">
                            </div>

                            <div class="experts_name text-center">
                            </div>
                        </div></div>
        </div>
    @endforeach
</div>
<div class="col-xl-4 col-md-6 col-lg-4"> 

                            <h3><a href="#">{{ $Request->name }}</a></h3>
                            <p>{{ $Request->des }}</p>
                            <p>{{ $Request->address }}</p>
                            <a href="{{ route('frontend.Request' , ['id' => $Request->id]) }}" class="boxed-btn3-white-2">عمل عرض</a>


                           
                            @if($Request->state == 2)
                            <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Well done!</h4>
                            <p>Aww yeah, you successfully</p>
                            
                            </div>
                            @endif
                            


</div>
</div>
</div>
</div>




