<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Str;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_can_be_created()
    {
        $service = Service::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'customer_name' => 'Test User',
            'phone' => '01700000000',
            'service_id' => $service->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure(['message', 'booking_id']);
    }

    public function test_booking_status_can_be_retrieved()
    {
        $service = Service::factory()->create();
        $booking = Booking::create([
            'id' => (string) Str::uuid(),
            'customer_name' => 'Test',
            'phone' => '01700000000',
            'service_id' => $service->id,
        ]);

        $response = $this->getJson('/api/bookings/' . $booking->id);

        $response->assertStatus(200)
                 ->assertJsonFragment(['customer_name' => 'Test']);
    }
}
