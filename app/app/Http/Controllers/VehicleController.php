<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicles\CreateVehicleRequest;
use App\Http\Requests\Vehicles\UpdateVehicleRequest;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return VehicleCollection
     */
    public function index(): VehicleCollection
    {
        return new VehicleCollection(
            Vehicle::whereOwnerId(Auth::user()->id)
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVehicleRequest $createVehicleRequest
     * @return JsonResponse
     */
    public function store(CreateVehicleRequest $createVehicleRequest)
    {
        $currentUser = Auth::user();
        $input = $createVehicleRequest->only([
            'name',
            'brand',
            'total_traveled_distance',
            'daily_traveled_distance',
            'last_petrol_refill',
            'last_oil_change',
            'last_maintenance',
        ]);
        $input['owner_id'] = $currentUser->id;

        Vehicle::create($input);

        return response()->json(status: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Vehicle $vehicle
     * @return VehicleResource
     */
    public function show(Vehicle $vehicle): VehicleResource
    {
        $this->authorize('view', $vehicle);
        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Vehicle $vehicle
     * @param UpdateVehicleRequest $updateVehicleRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Vehicle $vehicle, UpdateVehicleRequest $updateVehicleRequest): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $vehicle);
        $vehicle->update(
            $updateVehicleRequest->only([
                'name',
                'brand',
                'total_traveled_distance',
                'daily_traveled_distance',
                'last_petrol_refill',
                'last_oil_change',
                'last_maintenance',
            ])
        );

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Vehicle $vehicle): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', $vehicle);
        $vehicle->delete();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
