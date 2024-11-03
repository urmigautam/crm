<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- CSRF Token -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <link href='https://unpkg.com/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

  
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}"/>
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="urmila">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/images/logo-white.svg')}}">
     <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<body>
    
            @include('layouts.inc.header')
                <div class="container-fluid page-body-wrapper">
                    @include('layouts.inc.sidebar')
                    <main class="main-panel">
                    @if(session('error'))
                <div class="alert alert-danger" style="text-align: center;">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
            <!-- @include('layouts.inc.footer') -->
           </main>
           </div>
          
      
    </div>
    

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/js/template.js')}}"></script>
    <script src="{{ asset('assets/js/settings.js')}}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{ asset('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.13/index.global.min.js"></script>

   
   <script>
    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success') }}");
    @endif
    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif
    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif
    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

 
@stack('scripts')
</body>
</html>





