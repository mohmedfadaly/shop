@extends('back_end.layout.app')
@section('title')
بيانات المدينة
@endsection
@section('content')

<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">بيانات المدينة</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"> <a href="{{ route('cities.create') }}" class="btn btn-white btn-round"><i class="fas fa-user-plus"></i>اضافة</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    <div class="row"style="margin: 0;">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
      <div class="container-fluid">
              <div class="card">
                <div class="card-header card-header-primary">
                
              

 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" thead-dark">
                        <tr><th>
                          ID
                        </th>
                        <th>
                          الاسم
                        </th>
                        <th style="text-align: left;">
                          التحكم
                        </th>
                      </tr></thead>
                      <tbody>
                    @foreach($cities as $City)
                        <tr>
                            <td>
                                {{ $City->id }}
                            </td>
                            <td>
                                {{ $City->name }}
                            </td>
                            
                            <td class="td-actions"style="text-align: left;">
                              <a href="{{ route('cities.edit' , ['id' => $City]) }}" rel="tooltip" title="" class="btn-customized-2" data-original-title="Edit">
                              <i class="far fa-edit"></i> تعديل
                              </a>

                              <form action="{{route('cities.destroy', ['id' => $City->id])}}" method="POST"style="display: inline;">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title="" class="btn btn-danger btn-customized-2" data-original-title="delete">
                                  <i class="fas fa-trash-alt"></i> مسح
                                  </button>

                              </form>
                            </td>
                        </tr>
                     @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
              </div>
                </div>
              </div>
              </div>
              </div>

@endsection