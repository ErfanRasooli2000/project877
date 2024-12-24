<?php

namespace Modules\User\UserManagement\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens , SoftDeletes , HasRoles ;

    protected $guard_name = 'client-api';

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'address_id',
    ];
}
