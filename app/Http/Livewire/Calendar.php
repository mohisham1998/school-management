<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class Calendar extends Component
{
    public $events = '';
    public $eventId = '';

    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }


    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];


        $this -> eventId = Event::insertGetId ([
            'title' => $event['title'],
            'start' => $event['start']
        ]);

    }

    public function eventDrop($event, $oldEvent)
    {
        if (!array_key_exists("id", $event)) {
            $eventdata = Event::find($this -> eventId);
        }
        else {
            $eventdata = Event::find($event['id']);
        }
        $eventdata->start = $event['start'];
        $eventdata->save();
    }


    public function eventRemove($id) {
        if (!$id) {
            $eventdata = Event::find($this -> eventId);
        }
        else {
            $eventdata = Event::find($id);
        }
        $eventdata -> delete();
        toastr()->success(trans('messages.success'));

    }


    public function render()
    {
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}
