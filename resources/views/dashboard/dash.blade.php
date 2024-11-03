@extends('layouts.apps')

@section('title','Manage Mastr')
@section('content')

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart1').getContext('2d');

    // Create a new Chart object
    var myChart1 = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: ['Total Generated Leads', 'Total Rejected Leads','Total Qualified Leads'], // Set the chart labels
            datasets: [{
                label: 'Leads', // Set the dataset label
                data: [<?php echo $leads; ?>, <?php echo $leads1; ?>, <?php echo $leads2; ?>], // Set the data for the dataset
                backgroundColor: ['#E43F40', '#33DAE1','#B5CB40'], // Set the background color for the dataset
            }]
        },
        options: {
            title: {
                display: true, // Display the chart title
                text: 'Leads' // Set the chart title text
            },
            scales: {
        y: {
            max: 50,
            min: 0,
            ticks: {
                stepSize: 1
            }
        }
    }}
  });

        document.getElementById('chartType1').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType1 = this.value;

  // Update the chart type in the Chart.js configuration
  myChart1.config.type = chartType1;

  // Update the chart
  myChart1.update();
        
    });

</script>
<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart').getContext('2d');

    // Create a new Chart object
    var myChart = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: ['Onboarded Customers'], // Set the chart labels
            datasets: [{
                label: 'Customers', // Set the dataset label
                data: [<?php echo $leads3; ?>,], // Set the data for the dataset
                backgroundColor: ['#9DBFE9', ], // Set the background color for the dataset
            }]
        },
       
        options: {
            title: {
                display: true, // Display the chart title
                text: 'Users' // Set the chart title text
            },
            scales: {
        y: {
            max: 50,
            min: 0,
            ticks: {
                stepSize: 1
            }
        }
    }
        }
        
    });
    document.getElementById('chartType').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType = this.value;

  // Update the chart type in the Chart.js configuration
  myChart.config.type = chartType;

  // Update the chart
  myChart.update();
  
});
</script>
<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart2').getContext('2d');

    // Create a new Chart object
    var myChart2 = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: [@foreach ($orders1 as $order)
                        ' {{ $order->year }}',
                    @endforeach], // Set the chart labels
            datasets: [{
                label: 'orders', // Set the dataset label
                data: [ @foreach ($orders1 as $order1)
                            '{{ $order1->total_sales }}',
                        @endforeach], // Set the data for the dataset
                backgroundColor: ['#A4E889' ], // Set the background color for the dataset
            }]
        },
        options: {
            title: {
                display: true, // Display the chart title
                text: 'sales' // Set the chart title text
            },
            scales: {
        y: {
            max: 5000000,
            min: 0,
            ticks: {
                stepSize: 100000
            }
        }
    }
        }
    });
      document.getElementById('chartType2').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType2 = this.value;

  // Update the chart type in the Chart.js configuration
  myChart2.config.type = chartType2;

  // Update the chart
  myChart2.update();
        
    });

</script>

<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart3').getContext('2d');

    // Create a new Chart object
    var myChart3 = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: ['Ongoing','Resolved','UnderReview','Pending'], // Set the chart labels
            datasets: [{
                label: ['Complaints'], // Set the dataset label
                data: [<?php echo $m1; ?>,<?php echo $m4; ?>,<?php echo $m3; ?>,<?php echo $m2; ?>,], // Set the data for the dataset
                backgroundColor: ['#E43F40', '#33DAE1','#B5CB40','#B097EA' ], // Set the background color for the dataset
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
      }}
    });
      document.getElementById('chartType3').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType3 = this.value;

  // Update the chart type in the Chart.js configuration
  myChart3.config.type = chartType3;

  // Update the chart
  myChart3.update();
        
    });

</script>


<script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: [
                        <?php
                        // Get the followups from the database
                  
        

                        // Loop through the followups and create an array of events
                        foreach ($followups as $followup) {
 
                            $event = [
                                'id' => $followup->id,
                                'title' => $companies->whereIn('id',$followup->company_id)->pluck('name'),
                                'start' => $followup->next_followup,
                                'end' => $followup->next_followup	,
                                'url'=> '/complaints/updates/?id='.$followup->id
                              
                            ];

                            // Encode the event as JSON
                            $eventJson = json_encode($event);

                            // Print the event JSON
                            echo $eventJson . ',';
                        
                          }      
                        
                        ?>
                    ],
                    eventBackgroundColor:'#0B093E',
                    eventTextColor:'#F8F8F8'
                 
                });

                calendar.render();
            });
        </script>

<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart5').getContext('2d');

    // Create a new Chart object
    var myChart5 = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: [@foreach ($orders as $order)
                        ' {{ $order->date }}',
                    @endforeach], // Set the chart labels
            datasets: [{
                label: 'Sales', // Set the dataset label
                data: [ @foreach ($orders as $order1)
                            '{{ $order1->total_sales }}',
                        @endforeach], // Set the data for the dataset
                backgroundColor: ['#CB8BDE' ], // Set the background color for the dataset
            }]
        },
    
        options: {
            title: {
                display: true, // Display the chart title
                text: 'sales' // Set the chart title text
            },
            scales: {
        y: {
            max: 3000000,
            min: 0,
            ticks: {
                stepSize: 100000
            }
        }
    }
        }
        
    });
    document.getElementById('chartType5').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType5 = this.value;

  // Update the chart type in the Chart.js configuration
  myChart5.config.type = chartType5;

  // Update the chart
  myChart5.update();
  
});
</script>


<script>
    // Get the context of the canvas element
    var ctx = document.getElementById('myChart6').getContext('2d');

    // Create a new Chart object
    var myChart6 = new Chart(ctx, {
        type: 'bar', // Set the chart type to 'bar'
        data: {
            labels: [@foreach ($purposals as $purposal)
                        ' {{ $purposal->date }}',
                    @endforeach], // Set the chart labels
            datasets: [{
                label: 'Sales', // Set the dataset label
                data: [ @foreach ($purposals as $purposal1)
                            '{{ $purposal1->total_sales }}',
                        @endforeach], // Set the data for the dataset
                backgroundColor: ['#EFDD9A' ], // Set the background color for the dataset
            }]
        },
    
        options: {
            title: {
                display: true, // Display the chart title
                text: 'Purposals' // Set the chart title text
            },
            scales: {
        y: {
            max: 5500000,
            min: 0,
            ticks: {
                stepSize: 100000
            }
        }
    }
        }
        
    });
    document.getElementById('chartType6').addEventListener('change', function() {
  // Get the selected value from the select box
  const chartType6 = this.value;

  // Update the chart type in the Chart.js configuration
  myChart6.config.type = chartType6;

  // Update the chart
  myChart6.update();
  
});
</script>
@endpush

<div class="container-fluid px-4">
<div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-header">
                <h4 class="card-title"style="float:left;" href="#">Dashboard-Welcome ,<b>{{Auth::guard('admin')->user()->name}}</b></h4>
                    
                    </div>
                  <div class="card-body">

                  <div class="row">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
      <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6" >Total Generated Leads</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">{{$leads}}</h4>
                  </div>
                  <div class="col-4">
              
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-n45"></i>
                      </span>
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
      <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Total Qualified Leads</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">{{$leads2}}</h4>
                  </div>
                  <div class="col-4">
              
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-n45"></i>
                      </span>
          
                    </div>
                  </div>
                </div>
              </div>
            </div>
       
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
      <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Total Rejected Leads</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">{{$leads1}}</h4>
                  </div>
     
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-success-subtle text-success rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-n45"></i>
                      </span>
                 
                    </div>
                  </div>
                </div>
              </div>
            </div>
       
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
      <div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Onboarded Customers</h5>
                    <h4 class="card-subtitle text-body-secondary m-0">{{$leads3}}</h4>
                  </div>
             
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                  
                    </div>
                  </div>
                </div>
              </div>
            </div>

       
      </div>
    </div>
  </div>
</div>
                  

<div class="card-body">

<div class="row">
<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Onboarded Customers</h5>
                 
                  </div>
                  <div class="col-2">
                  <select name="chartType" id="chartType">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
       
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
             
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart"></canvas>
                    </div>
                  </div>


                </div>

           
              </div>
            </div>
</div>
<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Lead Status</h5>
                 
                  </div>
                  <div class="col-2">
                  <select name="chartType" id="chartType1">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
         
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
             
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart1"></canvas>
                    </div>
                  </div>
                </div>

           
              </div>
            </div>

</div>
<div>


  </div>

  <div class="row">
<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Orders</h5>
  </div>
  <div class="col-2">
                  <select name="chartType" id="chartType2">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart2"></canvas>
                    </div>
                  </div>
                </div>

           
              </div>
            </div>

</div>


<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Complaints Status</h5>
  </div>
  <div class="col-2">
                  <select name="chartType" id="chartType3">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart3"></canvas>
                    </div>
                  </div>
                </div>

           
              </div>
            </div>

</div>
<div>


<div class="row">
<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Total Orders</h5>
  </div>
  <div class="col-2">
                  <select name="chartType" id="chartType5">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart5"></canvas>
                    </div>
                  </div>
                </div>

           
              </div>
            </div>

</div>


<div class="col-sm-6">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <h5 class="card-title widget-card-title mb-3 fs-6">Total Proposals</h5>
  </div>
  <div class="col-2">
                  <select name="chartType" id="chartType6">
                  <option value="bar">Bar</option>
            <option value="line">Line</option>
            <option value="doughnut">Pie</option>
            <option value="radar">Radar</option>
            <option value="polarArea">Polar Area</option>
        </select>
  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex align-items-center mt-3">
                      <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                        <i class="bi bi-arrow-right-short bsb-rotate-45"></i>
                      </span>
                      <canvas id="myChart6"></canvas>
                    </div>
                  </div>
                </div>

           
              </div>
            </div>

</div>
<div>

<div class="row">
<div class="col-sm-12">
<div class="card widget-card border-light shadow-sm">
              <div class="card-body p-4">
                <div class="row">
           
                    <h5 class="card-title widget-card-title mb-3 fs-6">Follow ups</h5>

<div>
                <div class="row">
                  <div class="col-12">
                    <div class="d-flex ">
                  
                    <div id="calendar" class="w-100 h-100" ></div>
                    </div>
                  </div>
                </div>
               </div>
            </div>
          </div>
         </div>
       </div>
                  </div>
                </div>
              </div>
              </div>
 @endsection