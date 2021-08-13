<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use Fligno\Auth\Models\OauthToken;
use Illuminate\Support\Facades\Artisan;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    // HTTP status constants
    const HTTP_BAD_REQUEST = 400;
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NO_CONTENT = 204;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_WRONG_METHOD = 405;
    const HTTP_FORBIDDEN = 403;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_INTERNAL_ERROR = 500;
    const HTTP_SERVICE_UNAVALIABLE = 503;

    // HTTP method constants
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';
    const HTTP_METHOD_PATCH = 'PATCH';

     protected function createToken() : array
     {
       $user = User::find(2);
        $this->postJson('api/login', ['email' => 'admin@fligno.com', 'password' => 'Default123'])
        ->assertSuccessful()
        ->assertJsonStructure(['access_token', 'token_type', 'expires_at']);
        
        $this->assertAuthenticatedAs($user, 'web');
         return ['Authorization' => 'Brearer e50f7b244d0203e91cd44332fc102f6912655abe903aca3e75ac099a0ed20c8b408eef788cb26b73','Accept' => 'application/json'];
     }
}
