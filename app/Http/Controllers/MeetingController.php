<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Http\Resources\MeetingResource;
use App\Models\Meeting;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;

class MeetingController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $meetings = Meeting::with('contact')->paginate(10);

        return MeetingResource::collection($meetings);
    }

    public function show(Meeting $meeting): MeetingResource
    {
        return new MeetingResource($meeting);
    }

    public function store(StoreMeetingRequest $request): MeetingResource
    {
        $meeting = Meeting::create($request->validated());

        return new MeetingResource($meeting);
    }

    public function update(
        UpdateMeetingRequest $request,
        Meeting $meeting
    ): MeetingResource
    {
        $meeting->update($request->validated());

        return new MeetingResource($meeting);
    }

    public function destroy(Meeting $meeting): JsonResponse
    {
        $meeting->delete();

        return response()->json(null, 204);
    }
}