<?php

namespace Modules\Base\Traits;

trait HasScopes
{
    public function scopeSortIndex($query , $sort)
    {
        return $query->when(!empty($sort),
            function ($query) use ($sort) {
                $query->orderBy($sort['column'] , $sort['order']);
            },
            function ($query) {
                $query->orderBy('id', "desc");
            });
    }
}
