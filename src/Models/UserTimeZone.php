<?php

namespace Fligno\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTimeZone extends Model
{
    use HasFactory;
    protected $fillable = [
         'user_id',
         'time_zone',
    ];
}
