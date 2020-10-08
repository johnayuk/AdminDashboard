@extends('layouts.master')
@section('content')

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
 
   <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title"> Patient Records</h4>
                 @if(Auth::check() && Auth::user()->role  == "Admin"|| Auth::user()->role  == "superadmin")
                        <h4> <a href="##"  data-toggle="modal" data-target="#addpatientmodal">
                      <i class="now-ui-icons"></i>
                      <p style="color:#007bff">Add patient record</p>
                    </a></h4>
                 @endif 
                </div>
    <div class="card-body">
          <div class="table-responsive">
              <table class="table">
                  <thead class=" text-primary">
                      <th>Patient Name</th>
                      <th>Condition</th>
                      <th>Date</th>
                      <th>patient_ward</th>
                      <th>doctor_assigned</th>
                      @if(Auth::check() && Auth::user()->role  == "Admin"|| Auth::user()->role  == "superadmin")
                      <th>Edit</th>
                      @endif
                      <th>Delete</th>
                      <tbody>
                          @foreach ($records as $record)
                            <tr>
                              <td>{{$record->patient_name}}</td>
                              <td>{{$record->patient_condition}}</td>
                              <td>{{$record->created_at}}</td>
                              <td>{{$record->patient_ward}}</td>
                              <td>{{$record->doctor_assigned}}</td>
                              <td>
                                    <div class="modal fade" id="Updatpatientmodal{{$record->id}}" tabindex="-1" aria-labelledby="addpatientmodalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="UpdatpatientmodalLabel">Add Record</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                                  <form method="post"  action="{{url('/update-patient/'.$record->id)}}">
                                                          @csrf
                                                          @method('PUT')
                                                          <div class="form-group">
                                                              <label for="patient_name">Patient Name </lable>
                                                              <input  id="patient_name" type="text" name="patient_name" value="{{$record->patient_name}}" class="form-control">
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="patient_condition">Patient Condition </lable>
                                                              <input  id="patient_condition" type="text" name="patient_condition" value="{{$record->patient_condition}}" class="form-control"  required >
                                                          </div>

                                                          <div class="form-group">
                                                          <label for="patient_ward">Patient Ward</lable>
                                                          <input id="patient_ward" type="text" name="patient_ward" value="{{$record->patient_ward}}"  class="form-control"  required >
                                                          </div>


                                                          <div class="form-group">
                                                          <label for="doctor_assigned">'Patient doctor</lable>
                                                          <input type="text" id="doctor_assigned" name="doctor_assigned" value="{{$record->doctor_assigned}}" class="form-control"  required >
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="submit" class="btn btn-primary">Submit</button>
                                                      </div>
                                                  </form>
                                      </div>
                                    </div>
                                  </div>
                                  @if(Auth::check() && Auth::user()->role  == "Admin"|| Auth::user()->role  == "superadmin")
                                  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#Updatpatientmodal{{$record->id}}">Edit</button>
                                  @endif
                              </td>


                              <td>
                              <div class="modal fade" id="delete_patient{{$record->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <form id="delete_modal" action="{{url('/delete-patient/'.$record->id)}}" method="post">
                                                          @csrf
                                                          @method('DELETE')
                                                  <h3>Are you sure want to delete Patient {{$record->patient_name}} Record ?</h3>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                      </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                       @if(Auth::check() && Auth::user()->role  == "Admin"|| Auth::user()->role  == "superadmin")
                                        <button type='button' class="btn btn-danger" data-toggle="modal" data-target="#delete_patient{{$record->id}}">Delete</button>
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






  <div class="modal fade" id="addpatientmodal" tabindex="-1" aria-labelledby="addpatientmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addpatientmodalLabel">Add Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <form method="POST" action="{{ route('patients') }}">
                        @csrf
                        <div class="form-group">
                            <x-jet-label value="{{ __('Patient Name') }}" />
                            <x-jet-input class="form-control" type="text" name="patient_name" :value="old('name')" required autofocus autocomplete="name" />
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Patient Condition') }}" />
                            <x-jet-input class="form-control" type="text" name="patient_condition" :value="old('email')" required />
                        </div>


                        <div class="form-group" style="display: none">
                            <x-jet-label value="{{ __('Added_by') }}" />
                            <x-jet-input class="form-control" type="text" name="added_by" required value="{{$user->id}}" />
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Patient Ward') }}" />
                            <x-jet-input class="form-control" type="text" name="patient_ward" :value="old('email')" required />
                        </div>


                        <div class="form-group">
                            <x-jet-label value="{{ __('Patient doctor') }}" />
                            <x-jet-input class="form-control" type="text" name="doctor_assigned" :value="old('email')" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
    </div>
  </div>
 </div>


@endsection


@section('scripts')



@endsection
