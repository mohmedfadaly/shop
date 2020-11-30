
<section class="blog_area single-post-area section-padding"id="profileCard">
      <div class="container">
      <h4 style="margin-top: 10px;margin-bottom: 5px;text-align: center;">الطلبات</h4>
         <div class="row">
        
         @foreach($Request as $Request)
         @if($Request->state == 0)
         
            <div class="col-lg-12 posts-list">
               <div class="single-post">

<div class="quote-wrapper">
                    <div class="quotes">
                    
                        <div class="col-lg-12">
                            @include('front-end.shared.requ-card')
                        </div>
                   
                    </div>
            </div>
    </div>
    </div>
    @endif
    @endforeach
    
    </div>
    </div>
    </section>