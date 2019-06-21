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
      <!--form -->
      <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Pic</th>
                        <th>video</th>
                        <th>unit</th>
                  
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Pic</th>
                        <th>video</th>
                        <th>unit</th>
                       
                      </tr>
                    </tfoot>
                    <tbody>
                    
                        @foreach ($units as $unit)
                        <td>
                            {{$unit->UN_id}}
                            </td>
                            <td>
                                {{$unit->U_name}}
                                </td>
                                <td>
                                <img src="{{asset('uploads/'.$unit->pic)}}" style="width:50px ; lenght:50px;">
                                  </td>
                                  <td>
                                    {{$unit->video}}
                                    </td>
                                    <td>
                                      {{$unit->U_name}}
                                      </td>
                            
                                <tr>   
                        @endforeach
                        
                    </tbody>
                  </table>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col">
                        <input type="text" class="form-control" placeholder="First name" name="name" required>
                      </div>
                
                      
                          
                            <div class="row">
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Add Video URL" name="video" required>
                                </div>
                            
                                <div class="row">
                                    <div class="col">
                                   <select name="unit_id" class="form-control " required>
                                       @foreach ($allunit as $unit)
                                       <option value="{{$unit->UN_id}}">
                                            {{$unit->U_name}}
                                        </option>
                                       @endforeach
                                     
                                   </select>
                                    </div>
                                </div>
                                
                                <div class="row">
                                  <div class="col">
                                    <input type="file" name="pic" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                          <button type="submit" class="btn btn-primary">Add</button>
                        
                      
                      </form>
            </div>
      </div>
        




    @endsection