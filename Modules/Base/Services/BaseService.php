<?php

namespace Modules\Base\Services;

class BaseService
{
    protected function requestFilter(array $attributes = []) : array
    {
        $request = request();
        $filters = [];

        foreach ($attributes as $attribute)
        {
            $value = $request->$attribute;

            if ($value === "true")
                $filters[$attribute] = true;
            else if ($value === "false")
                $filters[$attribute] = false;
            else if ($value === '0')
                $filters[$attribute] = (int) $value;
            else
                $filters[$attribute] = !empty($value) ? $value : null;
        }

        $filters['per_page'] = $request->get('per_page', 15);
        $filters['sort'] = $request->get('sort') ?? [];

        return $filters;
    }
}
