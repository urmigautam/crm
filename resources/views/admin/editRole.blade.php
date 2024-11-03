@extends('layouts.apps')

@section('title','Edit Role')
@section('content')

<div class="container-fluid px-4">

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Role</h4>
            <form enctype="multipart/form-data" action="{{url('/update-role/'.$role->id)}}" method="post" class="forms-sample">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Role Name</label>
                    <input type="text" class="form-control" value="{{$role->name}}" name="name" id="name" required placeholder="role name">
                     @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                </div>

                <!-- <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <div id="permissions_list">
                        @foreach ($permissions as $p)
                        <div class="form-check" style="margin-left: 25px;">
                            <input type="checkbox" class="form-check-input permission_checkbox" id="permission_{{$p->id}}" value="{{$p->id}}" name="permissions[]" {{$role->permissions->contains($p->id) ? 'checked' : ''}}>
                            <label class="form-check-label" style="margin-left:0px" for="permission_{{$p->id}}">{{$p->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div> -->
                <div class="form-group">
    <label for="permissions">Permissions</label>
    <div class="row">
        <div class="col-md-4">
            @php $total = count($permissions); $chunk = ceil($total / 3); $permissions = $permissions->chunk($chunk); @endphp
            @foreach($permissions[0] as $p)
            <div class="form-check" style="margin-left: 25px;">
                <input type="checkbox" class="form-check-input permission_checkbox" id="permission_{{$p->id}}" value="{{$p->id}}" name="permissions[]" {{$role->permissions->contains($p->id) ? 'checked' : ''}}>
                <label class="form-check-label" style="margin-left:0px" for="permission_{{$p->id}}">{{$p->name}}</label>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            @foreach($permissions[1] as $p)
            <div class="form-check" style="margin-left: 25px;">
                <input type="checkbox" class="form-check-input permission_checkbox" id="permission_{{$p->id}}" value="{{$p->id}}" name="permissions[]" {{$role->permissions->contains($p->id) ? 'checked' : ''}}>
                <label class="form-check-label" style="margin-left:0px" for="permission_{{$p->id}}">{{$p->name}}</label>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            @foreach($permissions[2] as $p)
            <div class="form-check" style="margin-left: 25px;">
                <input type="checkbox" class="form-check-input permission_checkbox" id="permission_{{$p->id}}" value="{{$p->id}}" name="permissions[]" {{$role->permissions->contains($p->id) ? 'checked' : ''}}>
                <label class="form-check-label" style="margin-left:0px" for="permission_{{$p->id}}">{{$p->name}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
                <button type="submit" class="btn btn-primary me-2">update</button>
            </form>
        </div>
    </div>
</div>

</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Function to get all selected permissions
        function getSelectedPermissions() {
            var selectedPermissions = [];
            $('.permission_checkbox:checked').each(function() {
                selectedPermissions.push($(this).val());
            });
            return selectedPermissions;
        }

        // Event listener for checkbox changes
        $('.permission_checkbox').change(function() {
            var selectedPermissions = getSelectedPermissions();
            console.log(selectedPermissions); // You can replace this with your desired action
        });
    });
</script>
@endpush