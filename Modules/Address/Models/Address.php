<?php

namespace Modules\Address\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'city_id',
        'province_id',
        'address',
    ];
}
