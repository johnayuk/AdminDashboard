@extends('layouts.master')
@section('content')

    

 


<!-- Button trigger modal -->
 <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button>  -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                      @csrf
                      <!-- @method('PUT') -->
                      <h3 class="font-weight-light">Register User</h3>

                      <div class="form-group">
                          <x-jet-label value="{{ __('Name') }}" />
                          <x-jet-input class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                      </div>

                      <div class="form-group">
                          <x-jet-label value="{{ __('Email') }}" />
                          <x-jet-input class="form-control" type="email" name="email" :value="old('email')" required />
                      </div>

                      <div class="form-group">
                          <x-jet-label value="{{ __('Role') }}" />
                          <!-- <select name="role" id="role" class="form-control border" required>
                              <option value="Select role">Select role</option>
                              <option value="Admin">Admin</option>
                              <option value="User">Doctor</option>
                              <option value="User">Patient</option>
                          </select> -->
                          <x-jet-input class="form-control" type="text" id="role"  name="role" :value="old('role')" required />
                      </div>

                      <div class="form-group">
                          <x-jet-label value="{{ __('Password') }}" />
                          <x-jet-input class="form-control" type="password" name="password" required autocomplete="new-password" />
                      </div>

                      <div class="form-group">
                          <x-jet-label value="{{ __('Confirm Password') }}" />
                          <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                      </div>
                      </div>
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                 </form>
      </div>
    </div>
  </div>





  <div class="container">
    @if ($errors->any())
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif
  </div>
 


 
 

 @if($user->role === 'Admin' || $user->role === 'superadmin')
 <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title"> Active Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead class=" text-primary">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                <tbody>
                                @foreach ($userlist as $user)


                                 <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>
                    <!-- Modal -->
              <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                    <form  action="{{url('/update-user/'.$user->id)}}" method="post">
                                        @csrf
                                        @method('PUT')

                                        <h3>Edit User : {{$user->name}}</h3>
                                        <div class="form-group">
                                          <label for="name">Name</label>
                                        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                          <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control">
                                        </div>

                                        <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" name="role" id="role" value="{{$user->role}}" class="form-control">
                                        </div>
                                        
                                  
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </form>
                  </div>
                </div>
              </div>
                                  <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#exampleModal{{$user->id}}">Edit</button>
              </td>
                      
                        
                                    <td>
<!-- Modal -->
                                          <div class="modal fade" id="staticBackdrop{{$user->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form id="delete_modal" action="{{url('/delete-user/'.$user->id)}}" method="post">
                                                          @csrf
                                                          @method('DELETE')
                                                  <h3>Are you sure want to delete ?</h3>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                      </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#staticBackdrop{{$user->id}}">Delete</button>
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
  @endif
 
  @if(Auth::check() && Auth::user()->role  == "doctor"|| Auth::user()->role  == "nurse"||Auth::user()->role== "worker"||Auth::user()->role == "patient")
  <h1 class="mt-4" style="text-align:center">You are not allow to view this page!</h1>
  @endif
@endsection


@section('scripts')




@endsection
