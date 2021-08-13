<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Fligno\Auth\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;

class TimeZoneApiTest extends TestCase
{
    use RefreshDatabase;
    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('passport:install');
        if(count(User::all()) == 0)
        {
            Artisan::call('db:seed RoleandPermission');
        }
    }
    /** @test */
    public function can_update_user_timezone()
    {

        
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);

     

        $headers = [ 'Authorization' => 'Bearer'];
        $payload = [
            'timezone' => 'Asia/Manila',
             
        ];



        $response = $this->json('POST', '/api/timezone', $payload, $headers)->assertStatus(200);

    }
}
