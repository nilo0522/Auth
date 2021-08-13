<?php

namespace Fligno\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
class OauthToken extends Model
{
    use HasFactory,HasApiTokens;

    protected $table = 'oauth_access_tokens';
    
}
