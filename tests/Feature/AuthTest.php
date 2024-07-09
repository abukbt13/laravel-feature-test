<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\AutTest;

class AuthTest extends AutTest
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function testRegisterIsSuccess(): void
    {// Create fake data for registration
        $data = [
            'name' => fake()->name,
            'email' => fake()->safeEmail,
            'password' => 'password', // ensure to hash this if necessary
            'password_confirmation' => 'password'
        ];

        // Make a POST request to the registration endpoint with the fake data
        $response = $this->post('/api/auth/register', $data);

        // Assert that the response status is 201 Created
        $response->assertStatus(201);
    }
    public function testLoginSuccsess(): void
    {

        // First, create a user to test the login
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Ensure the password is hashed
        ]);

        // Prepare the login data
        $loginData = [
            'email' => 'test@example.com',
            'password' => 'password',
        ];

        // Make a POST request to the login endpoint with the login data
        $response = $this->post('/api/auth/login', $loginData);

        // Assert that the response status is 200 OK
        $response->assertStatus(200);

    }
}
