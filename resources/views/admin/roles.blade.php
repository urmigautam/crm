@extends('layouts.apps')

@section('title', 'Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Roles and Permissions Management</h4>
            <a href="{{ url('/add-new-role') }}" class="btn btn-success">Add New Role</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                <div class="permission-container" style="white-space: nowrap;">
                                    @foreach ($role->permissions as $permission)
                                    <p style="background-color: #78d6c2; display: inline;padding:2px; margin-top:2px; white-space: normal;">{{$permission->name}}</p>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{ url('/edit-role/'.$role->id) }}">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection