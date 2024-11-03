@extends('layouts.apps')

@section('title', 'Add Lead')
@section('content')

<div class="container-fluid px-4">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Role</h4>
                <form enctype="multipart/form-data" action="{{url('/add-role')}}" method="post" class="forms-sample">
                    @csrf
                    <div class="form-group">
                        <label for="name">Role Name</label>
                        <input type="text" class="form-control" name="name" id="name" required placeholder="role name">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="permissions">Permissions</label>
                        <div class="row" style="padding-left: 28px;">
                            @php
                                $chunkedPermissions = $permissions->chunk(ceil($permissions->count() / 3));
                            @endphp
                            @foreach($chunkedPermissions as $chunk)
                                <div class="col-md-4">
                                    @foreach ($chunk as $p)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input permission_checkbox"
                                                id="permission_{{$p->id}}" value="{{$p->id}}" name="permissions[]">
                                            <label class="form-check-label" for="permission_{{$p->id}}">{{$p->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Function to get all selected permissions
            function getSelectedPermissions() {
                var selectedPermissions = [];
                $('.permission_checkbox:checked').each(function () {
                    selectedPermissions.push($(this).val());
                });
                return selectedPermissions;
            }

            // Event listener for checkbox changes
            $('.permission_checkbox').change(function () {
                var selectedPermissions = getSelectedPermissions();
                console.log(selectedPermissions); // You can replace this with your desired action
            });
        });
    </script>
@endpush