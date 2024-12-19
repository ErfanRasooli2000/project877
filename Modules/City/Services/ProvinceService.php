<?php

namespace Modules\City\Services;

use Illuminate\Support\Collection;
use Modules\City\Database\Repositories\Contracts\ProvinceRepositoryInterface;

class ProvinceService
{
    public function __construct(
        protected ProvinceRepositoryInterface $repository
    ){}

    public function getALl() :Collection
    {
        return $this->repository->getAllWithSelect(['id' , 'name']);
    }
}
