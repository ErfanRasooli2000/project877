<?php

namespace Modules\City\Database\Repositories\Repos;

use Illuminate\Support\Collection;
use Modules\Base\Repositories\Repos\BaseRepository;
use Modules\City\Database\Repositories\Contracts\CityRepositoryInterface;
use Modules\City\Models\City;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(
        protected City $model
    ){}

    public function getCitiesFormProvinceId(int $provinceId): Collection
    {
        return $this->model
            ->newQuery()
            ->where('province_id', $provinceId)
            ->get();
    }
}
