@extends('back_end.layout.app')
@section('title')
بيانات التحويل
@endsection
@section('content')

<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">بيانات التحويل</h1>
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
                    @foreach($trans as $tran)
                        <tr>
                            <td>
                                {{ $tran->id }}
                            </td>
                            <td>
                                {{ $tran->name }}
                            </td>
                            
                            <td class="td-actions"style="text-align: left;">
                            <a href="{{ route('trans.edit' , ['id' => $tran]) }}" rel="tooltip" title="" class="btn-customized-2" data-original-title="Edit">
                              <i class="far fa-edit"></i> عرض
                              </a>
                            @if($tran->state == '0')
                             

                              <form action="{{route('trans.destroy', ['id' => $tran->id])}}" method="POST"style="display: inline;">
                        
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" rel="tooltip" title="" class="btn btn-danger btn-customized-2" data-original-title="delete">
                                  <i class="fas fa-trash-alt"></i> مسح
                                  </button>

                              </form>
                              @endif
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