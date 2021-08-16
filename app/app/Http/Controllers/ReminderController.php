<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reminders\CreateReminderRequest;
use App\Http\Requests\Reminders\EditReminderRequest;
use App\Http\Resources\ReminderCollection;
use App\Http\Resources\ReminderResource;
use App\Models\Reminder;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReminderController extends Controller
{
    public function index(Vehicle $vehicle)
    {
        if ($vehicle->owner_id !== Auth::user()->id) {
            return response()->json(data: ['message' => 'Forbidden'], status: Response::HTTP_FORBIDDEN);
        }

        return new ReminderCollection($vehicle->reminders()->get());
    }

    public function show(Vehicle $vehicle, Reminder $reminder)
    {
        if ($vehicle->owner_id !== Auth::user()->id) {
            return response()->json(data: ['message' => 'Forbidden'], status: Response::HTTP_FORBIDDEN);
        }

        return new ReminderResource($reminder);
    }

    public function store(Vehicle $vehicle, CreateReminderRequest $createReminderRequest)
    {
        if ($vehicle->owner_id !== Auth::user()->id) {
            return response()->json(data: ['message' => 'Forbidden'], status: Response::HTTP_FORBIDDEN);
        }

        $input = $createReminderRequest->only(['name', 'last_remind', 'interval']);
        if (!empty($input['last_remind'])) {
            $input['next_remind'] = $this->updateNextRemind($input['last_remind'], $input['interval']);
        }
        $input['vehicle_id'] = $vehicle->id;
        Reminder::create($input);

        return response()->json(status: Response::HTTP_CREATED);
    }

    private function updateNextRemind(string $lastRemind, string $interval): string
    {
        return Carbon::parse($lastRemind)
            ->addDays($interval)
            ->toDateString();
    }

    public function update(Vehicle $vehicle, Reminder $reminder, EditReminderRequest $editReminderRequest)
    {
        if ($vehicle->owner_id !== Auth::user()->id) {
            return response()->json(data: ['message' => 'Forbidden'], status: Response::HTTP_FORBIDDEN);
        }

        $input = $editReminderRequest->only(['name', 'last_remind', 'interval']);
        if (!empty($input['last_remind'])) {
            $input['next_remind'] = $this->updateNextRemind($input['last_remind'], $input['interval']);
        }

        return response()->json(
            status: $reminder->update($input) ?
            Response::HTTP_NO_CONTENT :
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public function destroy(Vehicle $vehicle, Reminder $reminder)
    {
        if ($vehicle->owner_id !== Auth::user()->id) {
            return response()->json(data: ['message' => 'Forbidden'], status: Response::HTTP_FORBIDDEN);
        }

        return response()->json(
            status: $reminder->delete() ?
            Response::HTTP_NO_CONTENT :
            Response::HTTP_INTERNAL_SERVER_ERROR
        );
    }
}
