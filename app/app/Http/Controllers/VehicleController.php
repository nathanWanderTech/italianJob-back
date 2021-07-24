<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicles\CreateVehicleRequest;
use App\Http\Requests\Vehicles\UpdateVehicleRequest;
use App\Http\Resources\VehicleCollection;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

// TODO: add authorize, just owner of vehicle can index, show, delete, update that vehicle.
class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return VehicleCollection
     */
    public function index(): VehicleCollection
    {
        return new VehicleCollection(Vehicle::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateVehicleRequest $createVehicleRequest
     * @return JsonResponse
     */
    public function store(CreateVehicleRequest $createVehicleRequest)
    {
        $input = $createVehicleRequest->only([
            'name',
            'brand',
            'total_traveled_distance',
            'daily_traveled_distance',
            'last_petrol_refill',
            'last_oil_change',
            'last_maintenance',
        ]);
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
        $vehicle->delete();

        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}
