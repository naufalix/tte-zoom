<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardHome extends Controller
{
    
    public function index(){
        
        return view('dashboard.home',[
            "title" => "Dashboard | Home"
        ]);
    }

}
