<?php

namespace Modules\Base\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseWithAllQueriesService extends BaseService
{
    public function getAllWithPagination(): LengthAwarePaginator
    {
        return $this->repository->getAllWithPagination(
            $this->getFiltersForALlQuery(),
            $this->getWithsForAllQuery()
        );
    }

    public function getAllForExcel() :Collection
    {
        return $this->repository->getAll(
            $this->getFiltersForALlQuery(),
            $this->getWithsForAllQuery()
        );
    }

    abstract protected function getFiltersForALlQuery() :array;

    abstract protected function getWithsForAllQuery() :array;
}
