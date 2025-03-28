<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all(), 200);
    }

    public function store(EventRequest $request)
    {
        $event = Event::create($request->validated());
        return response()->json($event, 201);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event, 200);
    }

    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update($request->validated());
        return response()->json($event, 200);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(null, 204);
    }
}
