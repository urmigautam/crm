@extends('layouts.apps')

@section('title','Add Lead')
@section('content')

<div class="container-fluid px-4">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" style="float:left;">Add User Info</h4>
                <a class="btn btn-success" style="float:right;" href="{{url('/users')}}">View Users</a>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{url('/update-user/'.$user->id)}}" method="post" class="forms-sample">
                    @csrf 
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"  value="{{$user->name}}" required  name="name"placeholder="Username">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                               <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{$user->email}}"  placeholder="Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Profile</label>
                                <input type="file" class="form-control" id="image"  name="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="altemail">Alt Email address</label>
                                <input type="email" class="form-control" id="altemail"required name="altemail" value="{{$user->alternate_email}}" placeholder="alt Email">
                                @error('altemail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" class="form-control" value="{{$user->password}}" required id="pwd" name="pwd" placeholder="Password">
                                @error('pwd')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact No</label>
                                <input type="text" class="form-control" value="{{$user->mobile}}" required id="contact" name="contact" placeholder="contact number">
                                @error('contact')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                           
                          
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" required id="address" value="{{$user->address}}" name="address" placeholder="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-control" required name="status" id="status">
                                    <option value="active"  {{$user->status == "active" ? "selected" :""}}>Active</option>
                                    <option value="passive" {{$user->status == "passive" ? "selected" :""}}>Passive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="doj">Posting Date</label>
                                <input type="date" class="form-control" id="doj" name="doj" value="{{$user->posting_date}}">

                                @error('doj')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company">Select Company</label>
                                <select class="form-control" required name="company" id="company">
                                    @foreach ($allcompanies as $company)
                                        <option value="{{$company->id}}" {{$user->company_id == $company->id ? "$company->id" :""}}>{{$company->name}}</option>
                                    @endforeach
                                </select>
                                @error('company')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select class="form-control" required name="role" id="role">
                                  @foreach ($allroles as $role)
                                      <option value="{{$role->id}}" {{$role->id == $user->role ? "selected" : ""}}>{{$role->name}}</option>
                                  @endforeach
                              </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                      <label for="gender">Gender</label><br>
                      <input type="radio" name="gender" value="male" id="male" {{$user->gender == 'male' ? "checked" : ""}}>

                      <label for="male">Male</label><br>
                      <input type="radio" name="gender" value="female" id="female" {{$user->gender == 'female' ? "checked" : ""}}>
                      <label for="female">Female</label><br>
                      @error('gender')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection