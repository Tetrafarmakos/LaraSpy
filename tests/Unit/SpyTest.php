<?php


use App\Models\Spy;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpyTest extends TestCase
{
    use DatabaseTransactions;
    use WithFaker;

    public function test_user_needs_authentication_to_create_spy()
    {
        $data = [
            'name' => 'James',
            'surname' => 'Bond',
            'agency' => 'MI6',
            'country_of_operation' => 'United Kingdom',
            'date_of_birth' => '1920-11-11',
        ];

        $response = $this->postJson('/api/spies', $data);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_spy()
    {
        $this->actingAs(User::factory()->create(), 'sanctum');

        $data = [
            'name' => 'James',
            'surname' => 'Bond',
            'agency' => 'MI6',
            'country_of_operation' => 'United Kingdom',
            'date_of_birth' => '1920-11-11',
        ];

        $response = $this->postJson('/api/spies', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('spies', [
            'name' => 'James',
            'surname' => 'Bond',
        ]);
    }

    public function test_can_list_random_spies()
    {
        Spy::factory()->count(10)->create();

        $response = $this->getJson('/api/spies/random');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_can_list_spies_with_pagination()
    {
        Spy::factory()->count(20)->create();

        $response = $this->getJson('/api/spies?page=1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'links',
            'current_page'
        ]);
    }

    public function test_unsupported_filter_returns_error()
    {
        $response = $this->getJson('/api/spies?unsupported_filter=value');

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Unsupported filter: unsupported_filter'
        ]);
    }
}
