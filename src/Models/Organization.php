<?php

namespace Fligno\Auth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fligno\Auth\Database\Factories\OrganizationFactory;
class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'company',
        'email',
        'contact',
        'address'
    ];
    protected static function newFactory()
    {
        return OrganizationFactory::new();
    }
}
