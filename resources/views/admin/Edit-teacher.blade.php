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
<form method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{$teachers->name}}" name="name" required>
        </div>

        <!--email-->
        <div class="row">
            <div class="col">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{$teachers->email}}" name="email" required>
            </div>
             <!--password-->
        <div class="row">
            <div class="col">
                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password"  required>
            </div>
             <!--confirm-->
        <div class="row">
            <div class="col">
              <input type="password" class="form-control" placeholder="confirm password" name="password_confirmation" required>
            </div>

        </div>
    </div>
</div>

    </div>
           <br>                 
          <button type="submit" class="btn btn-primary">Add</button>
        
      
      </form>
      <h1> All teachers</h1>
      <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
                   
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Number</th>
                    <th>Name</th>
                    <th>Email</th>
              
                
                  </tr>
                </tfoot>
                <tbody>
                
                  
                 <td>
                        {{$teachers->id}}
                        </td>
                        <td>
                                {{$teachers->name}}
                        </td>
                        <td>
                                {{$teachers->email}}
                        </td>
                   
                    
                </tbody>
              </table>
        
            </div>
        </div>
        
      @endsection