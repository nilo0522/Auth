<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
   use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        Artisan::call('passport:install');
    }

    /** @test */
    public function admin_can_login()
    {

        $this->withoutExceptionHandling();

        $password = 'secret123';
        $user = User::factory()->create(
            [ 'email' => 'test@fligno.com',
        'password' => bcrypt($password),]);

        $this->postJson('/api/login', ['email' => 'admin@fligno.com', 'password' => "Default123"])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token', 'token_type', 'expires_at']);

    }


}
