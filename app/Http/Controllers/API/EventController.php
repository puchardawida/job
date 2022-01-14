<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Event as EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Validator;

class EventController extends BaseController
{
    public function index()
    {
        $events = Event::all();                        
        return $this->sendResponse(EventResource::collection($events), 'Events fetched.');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|unique:events|max:255',
            'date_start' => 'required|date_format:Y-m-d H:i:s',
            'date_end' => 'required|date_format:Y-m-d H:i:s|after:date_start',
            'status_id' => 'required|exists:statuses,id',
            'user_id' => 'required|exists:users,id'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $event = Event::create($input);
        return $this->sendResponse(new EventResource($event), 'Event created.');
    }

   
    public function show($id)
    {
        $event = Event::find($id);
        if (is_null($event)) {
            return $this->sendError('Event does not exist.');
        }
        return $this->sendResponse(new EventResource($event), 'Event fetched.');
    }
    

    public function update(Request $request, Event $event)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'unique:events|max:255',
            'date_start' => 'date_format:Y-m-d H:i:s',
            'date_end' => 'date_format:Y-m-d H:i:s|after:date_start',
            'status_id' => 'exists:statuses',
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        if($input['name'])
            $event->name = $input['name'];
        if(isset($input['date_start']))
            $event->date_start = $input['date_start'];
        if(isset($input['date_end']))
            $event->date_end = $input['date_end'];
        if(isset($input['status_id']))
            $event->status_id = $input['status_id'];
        $event->save();
        
        return $this->sendResponse(new EventResource($event), 'Event updated.');
    }
   
    public function destroy(Event $event)
    {
        $event->delete();
        return $this->sendResponse([], 'Event deleted.');
    }
}
