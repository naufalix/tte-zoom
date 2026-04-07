<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Letter;
use Illuminate\Http\Request;

class DashboardLetter extends Controller
{
    
    public function index(){
        return view('dashboard.tte-elektronik',[
            "title" => "Pengajuan TTE Elektronik"
        ]);
    }

    public function report(){    
        
        $done = Letter::where('status', 1)->count();
        $waiting = Letter::where('status', 0)->count();
            
        return view('dashboard.laporan-tte', [
            "title" => "Laporan TTE",
            "letters" => Letter::orderBy('id', 'desc')->get(),
            "done" => $done,
            "waiting" => $waiting
        ]);
    }

    public function report_filter(Request $request){
        $start = $request->month_start . '-01';
        $end = date("Y-m-t", strtotime($request->month_end . '-01'));

        $letters = Letter::whereBetween('submission_date', [$start, $end])->orderBy('id', 'desc')->get();
        $done = Letter::where('status', 1)->whereBetween('submission_date', [$start, $end])->count();
        $waiting = Letter::where('status', 0)->whereBetween('submission_date', [$start, $end])->count();

        return view('dashboard.laporan-tte', [
            "title" => "Laporan TTE (".$request->month_start." sampai ".$request->month_end.")",
            "letters" => $letters,
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
        if ($request->submit == 'destroy') {
            $res = $this->destroy($request);
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
            'company'=>'required',
            'type'=>'required'
        ]);
        
        Letter::create($validatedData);
        return ['status'=>'success','message'=>'Data berhasil disimpan'];
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'id'=>'required|numeric',
            'name'=>'required',
            'gender'=>'required',
            'position'=>'nullable',
            'submission_date'=>'required',
            'company'=>'required',
            'type'=>'required',
            'status'=>'required'
        ]);
        
        $letter = Letter::find($request->id);

        //Check if the data is found
        if(!$letter){
            return ['status'=>'error','message'=>'Data tidak ditemukan'];
        }
        
        // Update data
        $letter->update($validatedData);    
        return ['status'=>'success','message'=>'Data berhasil disimpan'];
    }

    public function destroy(Request $request){
        
        $validatedData = $request->validate([
            'id' => 'required|numeric',
        ]);
        
        $letter = Letter::find($request->id);
        
        // Check if the data is found
        if (!$letter) {
            return ['status' => 'error', 'message' => 'Data tidak ditemukan'];
        }

        $letter->delete();
        return ['status' => 'success', 'message' => 'Data berhasil dihapus'];
    }
}
