<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function showEvents(){
        $events = DB::table('events')
                    ->select('events.id','events.name as event_name', 'events.date_start', 'events.date_end', 'events.slug', 'users.name as user_name')
                    ->join('users', 'users.id', '=', 'events.user_id')
                    ->get();
        
        return $events->toArray(); 
    }
}
