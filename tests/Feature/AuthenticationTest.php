<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

class AuthenticationTest extends TestCase
{
    /**
     * Test user registration
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $user = User::factory()->makeOne();

        $response = $this->postJson('/api/auth/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'User registration successful'
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
    }

    /**
     * Test user login
     *
     * @return void
     */
    public function testUserLogin()
    {
        $factory = User::factory()->makeOne();
        User::create([
            'name' => $factory->name,
            'email' => $factory->email,
            'password' => Hash::make('password123')
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $factory->email,
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data',
                'message'
            ]);

        $this->assertAuthenticated();
    }

    /**
     * Test invalid user credentials
     *
     * @return void
     */
    public function testInvalidCredentials()
    {

        $response = $this->postJson('/api/auth/login', [
            'email' => 'jane@example.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Invalid email or password'
            ]);

        $this->assertGuest();
    }

    /**
     * Test user logout
     *
     * @return void
     */
    public function testUserLogout()
    {
        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$token
        ])->postJson('/api/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);

        $this->assertGuest();
    }
}
