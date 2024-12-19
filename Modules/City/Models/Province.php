<?php

namespace Modules\City\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Province extends Pivot
{
    protected $table = 'provinces';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];
}
