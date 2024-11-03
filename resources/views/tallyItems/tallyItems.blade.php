@extends('layouts.apps')

@section('title', 'Manage Masters')
@section('content')

<div class="container-fluid px-4"></div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/add-item') }}" class="btn btn-success">Add New Ledger</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Ledger Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($count = 1)
                        @foreach ($itemData as $com)
                        <tr>
                           
                            <td>{{ $count }}</td>
                            <td>{{ $com['name']}}</td>
                            <td>{{ $com['opening_balance']}}</td>
                            <td>
                                <a href="{{ url('edit-item', ['item' =>$com['name']]) }}" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                              
                                <a href="{{ url('delete-item', ['item' =>$com['name']]) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @php($count++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection