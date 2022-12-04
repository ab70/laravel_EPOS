<?php

namespace App\Http\Controllers\Admin;

use App\Time;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeController extends Controller
{
    
    public function index()
    {
        $schedule = Time::all();
        dd($schedule);
    }
    
    public function edit($id)
    {
        $schedule_id = Time::FindOrFail($id);
        return view('admin.time.edit',compact('schedule_id'));
    }
    public function store(Request $request)
    {
        $input =$request->all();
        //dd($input);
        Time::create($input);
        return redirect()->back();
    }
    
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $schedule_update = Time::FindOrFail($id);
        $schedule_update->Update($input);
        //dd($input);
        return redirect('admin/date-time');
    }
    
    public function delete($id)
    {
        $time = Time::findOrFail($id);
        $time->delete();
        return redirect()->back();
    }
}
