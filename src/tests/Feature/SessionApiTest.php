<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Fligno\Auth\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
class SessionApiTest extends TestCase
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

    public function admin_can_update_session()
    {
        $data = 
        [
            'time' => 'Minute',
            'time_out' => '6'
        ];
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);

     

        $headers = [ 'Authorization' => 'Bearer'];
        $payload = [
            'time' => 'Minute',
             'timeout' => '6'
        ];



        $response = $this->json('POST', '/api/setting', $payload, $headers)->assertStatus(200);

            
    }
}
