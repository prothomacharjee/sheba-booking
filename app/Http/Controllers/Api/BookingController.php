<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Create a new service booking",
     *     tags={"Bookings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"customer_name", "phone", "service_id"},
     *             @OA\Property(property="customer_name", type="string", example="John Doe"),
     *             @OA\Property(property="phone", type="string", example="01700000000"),
     *             @OA\Property(property="service_id", type="integer", example=1),
     *             @OA\Property(property="schedule_time", type="string", format="date-time", example="2025-05-08T15:00:00Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Booking created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Booking created successfully"),
     *             @OA\Property(property="booking_id", type="string", format="uuid", example="550e8400-e29b-41d4-a716-446655440000")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'schedule_time' => 'nullable|date',
        ]);

        $booking = Booking::create([
            'id' => (string) Str::uuid(),
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'service_id' => $validated['service_id'],
            'schedule_time' => $validated['schedule_time'] ?? null,
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking_id' => $booking->id
        ], 201);
    }


    /**
     * @OA\Get(
     *     path="/api/bookings/{id}",
     *     summary="Get booking details by ID",
     *     tags={"Bookings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="UUID of the booking",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Booking details",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="string", example="550e8400-e29b-41d4-a716-446655440000"),
     *             @OA\Property(property="customer_name", type="string", example="John Doe"),
     *             @OA\Property(property="phone", type="string", example="01700000000"),
     *             @OA\Property(property="status", type="string", example="pending"),
     *             @OA\Property(property="schedule_time", type="string", format="date-time", example="2025-05-08T15:00:00Z"),
     *             @OA\Property(property="service", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="AC Repair"),
     *                 @OA\Property(property="price", type="number", format="float", example=1200.00)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Booking not found"
     *     )
     * )
     */
    public function show($id)
    {
        $booking = Booking::with('service')->findOrFail($id);
        return response()->json($booking);
    }
}
