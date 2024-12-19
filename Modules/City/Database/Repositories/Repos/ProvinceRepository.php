<?php

namespace Modules\City\Database\Repositories\Repos;

use Illuminate\Support\Collection;
use Modules\Base\Repositories\Repos\BaseRepository;
use Modules\City\Database\Repositories\Contracts\CityRepositoryInterface;
use Modules\City\Database\Repositories\Contracts\ProvinceRepositoryInterface;
use Modules\City\Models\City;
use Modules\City\Models\Province;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function __construct(
        protected Province $model
    ){}
}
