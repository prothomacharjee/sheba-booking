<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/services",
     *     summary="Get list of services",
     *     tags={"Services"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Service"))
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $services = Service::paginate(10);
        return response()->json($services);
    }
}
