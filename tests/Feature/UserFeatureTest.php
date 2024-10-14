<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function authenticated_user_can_access_their_own_data()
    {
        // Create a new user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Make a GET request to the /user endpoint
        $response = $this->get(route("user.profile"));

        // Assert that the response is successful
        $response->assertSuccessful();

        // Assert that the response contains the user's data
        $response->assertJson($user->toArray());
    }

    /**
     * @test
     */
    public function unauthenticated_user_cannot_access_their_own_data()
    {
        // Make a GET request to the /user endpoint without authentication
        $response = $this-> withoutMiddleware() -> get(route("user.profile"));

        // Assert that the response is unauthorized
        $response -> assertStatus(401);
    }
}
