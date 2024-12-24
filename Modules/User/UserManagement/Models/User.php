<?php

namespace Modules\User\UserManagement\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens , SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'address_id',
    ];
}
