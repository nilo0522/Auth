<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function setUp() : void
    {
        parent::setUp();

        Artisan::call('passport:install');
    }

    /** @test */
    public function admin_can_login()
    {

        $this->withoutExceptionHandling();

        $this->postJson('/api/admin/login', ['email' => 'admin@fligno.com', 'password' => "Default123"])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token', 'token_type', 'expires_at']);
    }

    /** @test */
    public function user_can_login()
    {
        $this->withoutExceptionHandling();

        $this->postJson('/api/login', ['email' => 'admin@fligno.com', 'password' => "Default123"])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token', 'token_type', 'expires_at']);

    }


}
