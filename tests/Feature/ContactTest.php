<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * POST /api/contacts
     *
     * @return void
     */
    public function test_can_create_contact(): void
    {
        $response = $this->postJson('/api/contacts', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '+12 345 678 905',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'first_name',
                    'last_name',
                    'phone_number',
                    'created_at',
                    'updated_at',
                ],
            ]);
        $this->assertDatabaseHas('contacts', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => '+12 345 678 905',
        ]);
    }

    /**
     * POST /api/contacts with missing fields
     *
     * @return void
     */
    public function test_phone_number_validation(): void
    {
        $response = $this->postJson('/api/contacts', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'phone_number' => 'invalid_phone',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('phone_number');
    }
}
