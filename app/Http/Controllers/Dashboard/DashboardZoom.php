<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Zoom;
use Illuminate\Http\Request;

class DashboardZoom extends Controller
{
    
    public function index(){    
        return view('dashboard.booking-zoom',[
            "title" => "Pengajuan Booking Zoom"
        ]);
    }

    public function report(){    
        
        $done = Zoom::where('status', 1)->count();
        $waiting = Zoom::where('status', 0)->count();
            
        return view('dashboard.laporan-zoom', [
            "title" => "Laporan Zoom",
            "zooms" => Zoom::orderBy('id', 'desc')->get(),
            "done" => $done,
            "waiting" => $waiting
        ]);
    }

    public function report_filter(Request $request){
        $start = $request->month_start . '-01';
        $end = date("Y-m-t", strtotime($request->month_end . '-01'));

        $zooms = Zoom::whereBetween('submission_date', [$start, $end])->orderBy('id', 'desc')->get();
        $done = Zoom::where('status', 1)->whereBetween('submission_date', [$start, $end])->count();
        $waiting = Zoom::where('status', 0)->whereBetween('submission_date', [$start, $end])->count();

        return view('dashboard.laporan-zoom', [
            "title" => "Laporan Zoom (".$request->month_start." sampai ".$request->month_end.")",
            "zooms" => $zooms,
            "done" => $done,
            "waiting" => $waiting
        ]);
    }
    
    public function postHandler(Request $request){
        if ($request->submit == 'store') {
            $res = $this->store($request);
            return back()->with($res['status'], $res['message']);
        }
        if ($request->submit == 'update') {
            $res = $this->update($request);
            return back()->with($res['status'], $res['message']);
        }
        if ($request->submit == 'filter') {
            return $this->report_filter($request);
        }
        return back()->with('info', 'Submit not found');
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name'=>'required',
            'gender'=>'required',
            'position'=>'nullable',
            'submission_date'=>'required',
            'hour'=>'nullable',
            'company'=>'required',
            'type'=>'required'
        ]);
        
        Zoom::create($validatedData);
        return ['status'=>'success','message'=>'Data berhasil disimpan'];

    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'gender'=>'required',
            'submission_date'=>'required',
            'hour'=>'nullable',
            'company'=>'required',
            'status'=>'required'
        ]);
        
        $zoom = Zoom::find($request->id);

        //Check if the data is found
        if(!$zoom){
            return ['status'=>'error','message'=>'Data tidak ditemukan'];
        }
        
        // Update data
        $zoom->update($validatedData);    
        return ['status'=>'success','message'=>'Data berhasil disimpan'];
        
    }
}
