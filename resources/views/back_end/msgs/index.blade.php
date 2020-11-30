@extends('back_end.layout.app')
@section('title')
بيانات رسائل الاعضاء
@endsection
@section('content')

<div class="content-wrapper">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">بيانات رسائل الاعضاء</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
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
                    @foreach($Umss as $ums)
                        <tr>
                            <td>
                                {{ $ums->id }}
                            </td>
                            <td>
                                {{ $ums->masg }}
                            </td>
                            
                            <td class="td-actions"style="text-align: left;">

                              <form action="{{route('ums.destroy', ['id' => $ums->id])}}" method="POST"style="display: inline;">
                        
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