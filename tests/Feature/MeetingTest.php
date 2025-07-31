<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST /api/meetings
     *
     * @return void
     */
    public function test_can_create_meeting(): void
    {
        $contact = Contact::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '+12 345 678 905',
        ]);

        $response = $this->postJson('/api/meetings', [
            'contact_id' => $contact->id,
            'address' => '123 Main St',
            'time' => '2023-10-01 10:00:00',
            'status' => 'planned',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'contact_id',
                    'address',
                    'time',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);

        $this->assertDatabaseHas('meetings', [
            'contact_id' => $contact->id,
            'address' => '123 Main St',
        ]);
    }
}
