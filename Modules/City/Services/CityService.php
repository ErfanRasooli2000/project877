<?php

namespace Modules\City\Services;

use Illuminate\Support\Collection;
use Modules\City\Database\Repositories\Contracts\CityRepositoryInterface;
use Modules\City\Models\Province;

class CityService
{
    public function __construct(
        protected CityRepositoryInterface $repository
    ){}

    public function getCitiesByProvince(Province $province) :Collection
    {
        return $this->repository->getCitiesFormProvinceId($province->id);
    }
}
