<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/admin/services",
     *     summary="List all services (Admin)",
     *     tags={"Admin Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="List of services",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Service")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Service::all());
    }

    /**
     * @OA\Post(
     *     path="/api/admin/services",
     *     summary="Create a new service (Admin)",
     *     tags={"Admin Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "category", "price"},
     *             @OA\Property(property="name", type="string", example="AC Repair"),
     *             @OA\Property(property="category", type="string", example="Electronics"),
     *             @OA\Property(property="price", type="number", format="float", example=1000.00),
     *             @OA\Property(property="description", type="string", example="Fix and clean AC")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created",
     *         @OA\JsonContent(ref="#/components/schemas/Service")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);
        $service = Service::create($data);
        return response()->json($service, 201);
    }


    /**
     * @OA\Put(
     *     path="/api/admin/services/{id}",
     *     summary="Update a service (Admin)",
     *     tags={"Admin Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Service ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="AC Repair Updated"),
     *             @OA\Property(property="category", type="string", example="Electronics"),
     *             @OA\Property(property="price", type="number", format="float", example=1200.00),
     *             @OA\Property(property="description", type="string", example="Deep AC cleaning")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service updated",
     *         @OA\JsonContent(ref="#/components/schemas/Service")
     *     )
     * )
     */
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'category' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'description' => 'nullable|string',
        ]);
        $service->update($data);
        return response()->json($service);
    }


    /**
     * @OA\Delete(
     *     path="/api/admin/services/{id}",
     *     summary="Delete a service (Admin)",
     *     tags={"Admin Services"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Service ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service deleted",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Service deleted")
     *         )
     *     )
     * )
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'Service deleted']);
    }
}
