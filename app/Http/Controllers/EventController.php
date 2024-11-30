<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         //// Fetch all events with related categories and locations
     $events = Event::with(['category', 'location'])->get();

        // Return the events as a collection of EventResource
    return EventResource::collection($events);

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'startdatetime' => 'required|date|after:now',
            'enddatetime' => 'required|date|after:startdatetime',
            'ticketsavailable' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location_type' => 'required|in:online,physical',
            'link_url' => 'nullable|url|required_if:location_type,online',
            'location_id' => 'nullable|exists:locations,id|required_if:location_type,physical',
            'location_description' => 'nullable|string',
            'img_url' => 'nullable|url',
        ]);

        // Add the authenticated user's ID to the event data
        $validatedData['user_id'] = auth()->id();

        // Create the event with the validated data
        $event = Event::create($validatedData);

        return new EventResource($event);
    }


    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'startdatetime' => 'required|date|after:now',
            'enddatetime' => 'required|date|after:startdatetime',
            'ticketsavailable' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'location_type' => 'required|in:online,physical',
            'link_url' => 'nullable|url|required_if:location_type,online',
            'location_id' => 'nullable|exists:locations,id|required_if:location_type,physical',
            'location_description' => 'nullable|string',
            'img_url' => 'nullable|url',
        ]);

        $event->update($validatedData);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $event
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'message' => 'Event deleted successfully',
        ]);
    }
}
