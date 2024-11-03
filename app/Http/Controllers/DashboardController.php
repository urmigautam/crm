<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Orders;
use App\Models\Lead;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\FollowUp;
use App\Models\purposal;
use App\Models\Complaints;
class DashboardController extends Controller
{
    public function index(){
        $data = User::selectRaw("date_format(created_at, '%Y-%m-%d') as date, count(*) as aggregate")
        ->whereDate('created_at', '>=', now()->subDays(365))
        ->groupBy('date')
        ->get();
    
        $totalUsers = User::count();
    
   
        $name = Auth::guard('admin')->user()->name;

       //$orders = Orders::get('amount');
       $orders = Orders::selectRaw('SUM(amount) as total_sales ,DATE(created_at) as date')
    ->groupBy('date')
    ->orderBy('date')
    ->get();

           //$orders = Orders::get('amount');
           $orders1 = Orders::selectRaw('SUM(amount) as total_sales ,YEAR(created_at) as year')
           ->groupBy('year')
           ->orderBy('year')
           ->get();
    $purposals = purposal::selectRaw('SUM(amount) as total_sales ,DATE(created_at) as date')
    ->groupBy('date')
    ->orderBy('date')
    ->get();
   


       $followups = FollowUp::where('next_followup_by',$name)->get();
          $followupIds = $followups->pluck('company_id');
       $companies = Company::All();
        $m1=Complaints::where('status','ongoing')->count();
        $m2=Complaints::where('status','pending')->count();
        $m3=Complaints::where('status','undereview')->count();
        $m4=Complaints::where('status','resolved')->count();
// Get the total number of failed leads
// Create a pie chart with the successful and failed leads data
       $stattus=['Generate','Rejected','Qualify'];
       $leadds=Lead::whereIn('status',$stattus)->count();
       $status=['Generate'];
            $leads=Lead::whereIn('status',$status)->count();
            $status1=['Rejected'];
            $leads1=Lead::whereIn('status',$status1)->count();
            $status2=['Qualify'];
            $leads2=Lead::whereIn('status',$status2)->count();
            $status3=['Customer'];
            $leads3=Lead::whereIn('status',$status3)->count();
            $users=User::count();
            toastr()->success('Total Users',$users);
            return view('dashboard.dash', compact('data','leads3','purposals','orders','orders1','leads','leads1','leads2','users','followups','m1','m2','m3','m4','companies'));
        
   }
}
