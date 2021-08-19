<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\Passport\Passport;
use Fligno\Auth\Models\Organization;
class OrganizationApiTest extends TestCase
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
    public function can_create_organization()
    {
        $data = [
            'email' => 'test@gmail.com',
            'company' => 'fligno',
            'contact' => '123',
            'address' => 'CDO',
        ];
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);
        $headers = [ 'Authorization' => 'Bearer'];
        $response = $this->json('post','api/organization',$data,$headers);

        $response->assertStatus(200);
    }
    /** @test */
    public function can_update_organization()
    {
        $data = [
            'email' => 'test@gmail.com',
            'company' => 'fligno',
            'contact' => '123',
            'address' => 'CDO',
        ];
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);
        $headers = [ 'Authorization' => 'Bearer'];
       
        $org =  Organization::factory()->create();
        $response = $this->json('put','api/organization/'.$org->id,$data,$headers);

        $response->assertStatus(200);
    }
    /** @test */
    public function can_delete_organization()
    {
        $this->withoutExceptionHandling();
        $user = User::where('email','admin@fligno.com')->first();
        Passport::actingAs($user);
        $headers = [ 'Authorization' => 'Bearer'];
        $org = Organization::factory()->create();
        $response = $this->json('delete','api/organization/'.$org->id,$headers);

        $response->assertStatus(200);

       
    }
   
}
