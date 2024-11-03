<nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
           <li class="nav-item {{Request::is('dashboard')  ?'active':''}}">
              <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
              </a>
            </li>
           @php

           use App\Models\Admin;
           use App\Models\Role;

           $user = Auth::guard('admin')->user();
       
           $Auth = Admin::where('id',$user['id'])->with('roles.permissions')->first();
           
           $role = Role::find($user->role); // Find the role by its ID or any other criteria
         
           @endphp
           @if($role->hasPermission('setting'))
            <li class="nav-item {{ Request::is('server-edit/*') || Request::is('company') || Request::is('/company-edit/*') || Request::is('add-company') ||Request::is('mail-setting') || Request::is('user-edit/*') || Request::is('edit-place-of-business/*') || Request::is('edit-currency/*') || Request::is('refrence-edit/*')  ==true  ?'active':''}}">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="fa-solid fa-gear menu-icon"></i>
                 <span class="menu-title">Setting</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('server-edit/*') || Request::is('company') || Request::is('company-edit/*') || Request::is('add-company') ||Request::is('mail-setting') || Request::is('user-edit/*') || Request::is('edit-place-of-business/*')|| Request::is('edit-currency/*') || Request::is('refrence-edit/*')  ==true?'show':''}}" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{url('/roles-management-system')}}">Roles</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/permission')}}">Permissions</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/company')}}">Company Master</a></li>
                  <li class="nav-item"> <a class="nav-link {{Request::is('server-edit/*') || Request::is('mail-setting') ?'active':''}}" href="{{url('/mail-setting')}}">Mail Setting</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="{{url('/users')}}">User</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="{{url('/refrences')}}">Refered By</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="{{url('/category-list')}}">Category</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{url('/place-of-bussiness')}}">Place Of Business</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="{{url('/currency-list')}}">Currency</a></li> 
                  <li class="nav-item"> <a class="nav-link" href="{{url('/items-list')}}">Items</a></li> 
                </ul>
              </div>
            </li>
         @endif
         @if($role->hasPermission('leads'))
            <li class="nav-item  {{ Request::is('leads') || Request::is('lead-edit/*')  || Request::is('lead-qualified')  || Request::is('lead-qualified-edit/*')  ?'active':'' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#lead" aria-expanded="false" aria-controls="lead">
                
                <i class="fa-solid fa-chalkboard-user menu-icon"></i>
                <span class="menu-title">Leads</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('/leads') || Request::is('lead-edit/*') ?'show':'' }}" id="lead">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item "> <a class="nav-link {{Request::is('/leads') || Request::is('lead-edit/*') ?'active':''}}" href="{{url('/leads')}}">Leads</a></li>
                   <li class="nav-item "> <a class="nav-link {{Request::is('/lead-qualified')  || Request::is('lead-qualified-edit/*')  ?'active':''}}" href="{{url('/lead-qualified')}}">Qualified Lead</a></li>
                
                </ul>
              </div>
            </li>
            @endif
            @if($role->hasPermission('on-boarding'))
            <li class="nav-item">
              <a class="nav-link"  href="{{url('/on-boarding')}}" aria-expanded="false" aria-controls="charts">
              
              <i class="fa-solid fa-person-snowboarding menu-icon"></i>
                <span class="menu-title">Onboarding</span>
                <i class="menu-arrow"></i>
              </a>
             
            </li>
          @endif

          @if($role->hasPermission('sales'))
            <li class="nav-item  {{ Request::is('customer-edit/*') || Request::is('sales') || Request::is('add-follow-up/*') || Request::is('add-new-proposal/*')  ?'active':'' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#sales" aria-expanded="false" aria-controls="sales">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Sales Process</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('customer-edit/*') || Request::is('/sales') || Request::is('add-follow-up/*') || Request::is('add-new-proposal/*')  ?'show':'' }}" id="sales">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item "> <a class="nav-link {{Request::is('add-follow-up/*') || Request::is('sales')  ?'active':''}}" href="{{url('/sales')}}">View Sales</a></li>
              
                </ul>
              </div>
            </li>
            @endif
            @if($role->hasPermission('orders'))
            <li class="nav-item  {{Request::is('order-detail/*')  ?'active':''}}">
              <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
                <i class="menu-icon mdi mdi-table"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{Request::is('order-detail/*')  ?'show':''}}" id="orders">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link {{Request::is('order-detail/*')  ?'active':''}}" href="{{url('/orders-data')}}">View Orders</a></li>
                  <!--<li class="nav-item"> <a class="nav-link {{Request::is('/purposals')  ?'active':''}}" href="{{url('/purposals')}}">View Purposals</a></li>-->
                </ul>
              </div>
            </li>
            @endif
            @if($role->hasPermission('complaints/dash'))
            <li class="nav-item {{ Request::is('edit/*')  ||Request::is('complaints/dash') ?'active':'' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#support" aria-expanded="false" aria-controls="support">
               
                <i class="fa-solid fa-arrow-up-from-ground-water menu-icon"></i>
                <span class="menu-title">Support</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{Request::is('edit/*') ||Request::is('complaints/dash') ?'show':'' }}" id="support">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link {{ Request::is('edit/*') ?'active':'' }}" href="{{url('/complaints/dash')}}">All Complaints</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{url('/complaints/create')}}">Add Complaints</a></li>
                  
              
                </ul>
              </div>
            </li>
            @endif
           
            <li class="nav-item {{ Request::is('/') ?'active':'' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#tally" aria-expanded="false" aria-controls="tally">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Account</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('/') ?'show':'' }}" id="tally">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link"  href="http://103.117.117.122:27000?Login='manish'" target="_blank">Tally</a></li>
                </ul>
              </div>
            </li>

            <li class="nav-item {{ Request::is('/') ?'active':'' }}">
              <a class="nav-link" data-bs-toggle="collapse" href="#tallys" aria-expanded="false" aria-controls="tallys">
                <i class="menu-icon mdi mdi-card-text-outline"></i>
                <span class="menu-title">Tally Data</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse {{ Request::is('/') ?'show':'' }}" id="tallys">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"><a class="nav-link"  href="{{url('/get-tally-ledgers')}}" >Tally Ledgers Data</a></li>
                  <li class="nav-item"><a class="nav-link"  href="{{url('/get-tally-items')}}" >Tally Items Data</a></li>
                </ul>
              </div>
              
              
             
            </li>
           
          </ul>
        </nav>

        