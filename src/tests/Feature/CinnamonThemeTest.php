<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CinnamonThemeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_cinnamon_cat_theme(): void
    {
        $user = User::factory()->create([
            'name' => 'Mochi',
            'email' => 'mochi@example.com',
        ]);

        $this->actingAs($user)
            ->get('/home')
            ->assertOk()
            ->assertSee('Cinnamon Cat')
            ->assertSee('Garden');
    }

    public function test_registered_users_can_be_created_with_validation(): void
    {
        $response = $this->post('/users/register', [
            'name' => 'Poppy',
            'email' => 'poppy@example.com',
            'password' => 'secret123',
        ]);

        $response->assertRedirect('/cinnamon');
        $this->assertDatabaseHas('users', ['email' => 'poppy@example.com']);
    }

    public function test_cinnamon_page_requires_authentication(): void
    {
        $this->get('/cinnamon')
            ->assertRedirect('/login');
    }
}
