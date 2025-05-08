<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Service;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_listing_returns_data()
    {
        Service::factory()->create(['name' => 'AC Repair']);

        $response = $this->getJson('/api/services');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'AC Repair']);
    }
}
