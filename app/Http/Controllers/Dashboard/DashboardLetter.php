<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class DashboardLetter extends Controller
{
    
    public function index(){
        return view('dashboard.tte-elektronik',[
            "title" => "Dashboard | TTE Elektronik"
        ]);
    }

    public function index2(){    
        return view('dashboard.booking-zoom',[
            "title" => "Dashboard | Booking Zoom"
        ]);
    }

    public function report(){    
        
        $done = Letter::where('status', 1)->count();
    
        $tte_done = Letter::where('status', 1)
            ->where('type', '!=', 'Booking Zoom')
            ->count();
    
        $zoom_done = Letter::where('status', 1)
            ->where('type', 'Booking Zoom')
            ->count();
    
        $waiting = Letter::where('status', 0)->count();
            
        return view('dashboard.laporan', [
            "title" => "Dashboard | Laporan",
            "letters" => Letter::orderBy('id', 'desc')->get(),
            "done" => $done,
            "tte_done" => $tte_done,
            "zoom_done" => $zoom_done,
            "waiting" => $waiting
        ]);
    }
    

    public function postHandler(Request $request){
        if ($request->submit == 'store') {
            $res = $this->store($request);
            return back()->with($res['status'], $res['message']);
        }


        return back()->with('info', 'Submit not found');
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name'=>'required',
            'gender'=>'required',
            'position'=>'nullable',
            'submission_date'=>'required',
            'company'=>'required',
            'type'=>'required'
        ]);
        
        Letter::create($validatedData);
        return ['status'=>'success','message'=>'Data berhasil disimpan'];

    }
}
