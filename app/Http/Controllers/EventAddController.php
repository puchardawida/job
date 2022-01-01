<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class EventAddController extends Controller
{
    public function showForm(){
        $statuses = Status::all();
        return view('event_form')->with('statuses', $statuses);
    }

    public function addEvent(Request $request){
        $event = new Event;
        $event->name = $request->name;
        $event->status_id = $request->status;
        $event->user_id = Auth::id();
        $event->slug = str_replace(' ', '-', $request->name);;
        $event->date_start = $request->date_start." ".$request->date_start_time;
        $event->date_end = $request->date_end." ".$request->date_end_time;
        $event->save();

        return redirect('/event/form');
    }
}
