<?php

namespace Modules\City\Database\Repositories\Contracts;

use Illuminate\Support\Collection;
use Modules\Base\Repositories\Contracts\BaseRepositoryInterface;

interface CityRepositoryInterface extends BaseRepositoryInterface
{
    public function getCitiesFormProvinceId(int $provinceId) :Collection;
}
