<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Fligno\Auth\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
class EmailScheduleApiTest extends TestCase
{
    use RefreshDatabase;
    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('passport:install');
        if(count(User::all()) == 0)
        {
            Artisan::call('db:seed FlignoAuthSeeder');
        }
    }
    /** @test */
    public function admin_can_update_email_schedule()
    {
        $data = [
            'days' => 'Tuesday',
            'email_time' => "13:00"
        ];
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);
        $headers = [ 'Authorization' => 'Bearer'];
        $response = $this->post('/api/mail',$data,$headers);

        $response->assertStatus(200);
    }
}
