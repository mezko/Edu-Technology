@extends('admin.admin-panel')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Add Lesson</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!--form -->
<div class="card-body">
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
    <form method="POST">
        @csrf
            <div class="row">
              <div class="col-md">
                <input type="text" class="form-control" placeholder="Unit Name" name="name">
              </div>
            </div>
            <br>
              <div class="row">
                <div class="col-md">
                  <input type="file" class="form-control" placeholder="upload Pic" name="pic">
                </div>
              </div>
              <br>
                <div class="row">
                    <div class="col-md">
                      <input type="text" class="form-control" placeholder="Add Video URL" name="video">
                    </div>
                </div>
                <br>
                    <div class="row">
                        <div class="col-md">
                       <select name="unit_id" class="form-control form-control-sm">
                           @foreach ($units as $unit)
                           <option value="{{$unit->id}}">
                                {{$unit->name}}
                            </option>
                           @endforeach
                         
                       </select>
                        </div>
                    </div>
                    <br>
              <div class="col-md">
              <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </div>
          </form>

</div>
<h1> All Lesson</h1>
<div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Edit</th>
            <th>Remove</th>
          </tr>
        </tfoot>
        <tbody>
        
            @foreach ($units as $unit)
            <td>
                {{$unit->id}}
                </td>
                <td>
                    {{$unit->name}}
                    </td>
                    <td>
                      <a href="/edit/unit/{{$unit->id}}"> <button  type="button" class="btn btn-primary">Edit</button></a>
                    </td>
                    <td>
                    <a href="/admin/remove/unit/{{$unit->id}}"> <button  type="button" class="btn btn-danger">Remove</button></a>
                      </td>
                    <tr>   
            @endforeach
            
        </tbody>
      </table>

    </div>
</div>
</div>
@endsection