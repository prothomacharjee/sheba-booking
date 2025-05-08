<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
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

    public function show($id)
    {
        $booking = Booking::with('service')->findOrFail($id);
        return response()->json($booking);
    }
}
