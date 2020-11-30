@extends('back_end.layout.app')
@section('title')
    الرائيسية
@endsection
@section('content')
<!-- Main content -->
<div class="content-wrapper">
<section class="content">
      <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ \App\models\Req::count() }}</h3>

                <p>الطلبات</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ \App\models\Section::count() }}</sup></h3>

                <p>الاقسام</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('sections.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ \App\models\City::count() }}</h3>

                <p>المدن</p>
              </div>
              <div class="icon">
              <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('cities.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ \App\models\User::count() }}</h3>

                <p>الاعضاء</p>
              </div>
              <div class="icon">
              <i class="ion ion-person-add"></i>
                
              </div>
              <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

           <!-- ./col -->
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ \App\models\Prov::count() }}</h3>

                <p>المتاجر</p>
              </div>
              <div class="icon">
              <i class="ion ion-person-add"></i>
                
              </div>
              <a href="{{route('providers.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        </div>
        <!-- /.card -->
        </section>
        </div>

@endsection