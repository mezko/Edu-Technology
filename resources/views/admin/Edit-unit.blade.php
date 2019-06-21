@extends('admin.admin-panel')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1 class="h3 mb-0 text-gray-800">Unit : {{$unit->U_name}}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      </div>
      @if(Session::has('success-message'))
      <div class="alert alert-success"> 
          <button type="button" 
              class="close" 
              data-dismiss="alert" 
              aria-hidden="true">&times;</button>
          {!! session()->get('success-message') !!} 
      </div>
  @endif
  @if (Session::has('delete-message'))
  <div class="alert alert-danger"> 
      <button type="button" 
          class="close" 
          data-dismiss="alert" 
          aria-hidden="true">&times;</button>
      {!! session()->get('delete-message') !!} 
  </div> 
      
          
  @endif
      <!--form -->
      <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                  </tr>
                </tfoot>
                <tbody>
                    <td>
                        {{$unit->UN_id}}
                    </td>
                    <td>
                        {{$unit->U_name}}
                    </td>
                </tbody>
              </table>
            </div>
            <div class="card-body">
            <form method="POST">
                    @csrf
                        <div class="row">
                          <div class="col-md">
                          <input type="text" class="form-control" placeholder="Unit Name" name="name" value="{{$unit->U_name}}">
                          </div>
                          <div class="col-md">
                          <button type="submit" class="btn btn-primary">Edit</button>
                          </div>
                        </div>
                      </form>
            </div>
      </div>
        




    @endsection