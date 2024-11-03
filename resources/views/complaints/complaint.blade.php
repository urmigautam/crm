@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

<div class="container-fluid px-4"></div>
@section('content')
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('chart').getContext('2d');

    // Create a new Chart object
    var chart = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: ['Total Ongoing Complaints', 'Total pending complaints','Total resolved complaints','Total underreview complaints'], // Set the chart labels
            datasets: [{
                label: 'Leads', // Set the dataset label
                data: [4,5,6,7], // Set the data for the dataset
                backgroundColor: ['#87cefa', '#FF0000','#3cb371','#3cvv676'], // Set the background color for the dataset
            }]
        },
        options: {
            title: {
                display: true, // Display the chart title
                text: 'Complaints' // Set the chart title text
            },
            scales: {
        y: {
            max: 10,
            min: 0,
            ticks: {
                stepSize: 1
            }
        }
    }
            
        
        }
        
    });
</script>
@endpush
<div class="container-fluid px-4">
<div class="col-lg-12 grid-margin stretch-card">
<div class="card-body">

<div class="row">
<div class="col-sm-8">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Complaints</h5>
                 
                  </div>
             
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="chart"></canvas>
                    </div>
                  </div>


                </div>

           
              </div>
            </div>
</div>
</div>
</div>
</div>


           
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                    <a href="{{url('/complaints/create')}}" class="btn btn-success">Add New Complaint</a>
                    </div>
                  
                  <div class="card-body">
                  
                   
                    </p>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>S.No </th>
                            <th>Complaint Number </th>
                            <th>Customer Id</th>
                            <th>Order No</th>
                            <th>Complaint Desc</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($complaints as $com)
                          <tr>
                            <td> {{$com->id}}</td>
                             <td> {{$com->complaint_number}}</td>
                             <td> {{$com->customer_id}}</td>
                             <td> {{$com->order_no}}</td>
                             <td> {{$com->complaint_desc}}</td>
                             <td> {{$com->status}}</td>
                            <td> 
                                <a class="btn btn-success" href="{{url('/complaints-edit/'.$com->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                               
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