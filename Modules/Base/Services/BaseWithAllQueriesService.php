<?php

namespace Modules\Base\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseWithAllQueriesService extends BaseService
{
    public function getAllWithPagination(bool $trashed = false): LengthAwarePaginator
    {
        return $this->repository->getAllWithPagination(
            $this->getFiltersForALlQuery(),
            $this->getWithsForAllQuery(),
            $trashed
        );
    }

    public function getAllForExcel(bool $trashed = false) :Collection
    {
        return $this->repository->getAll(
            $this->getFiltersForALlQuery(),
            $this->getWithsForAllQuery(),
            $trashed
        );
    }

    abstract protected function getFiltersForALlQuery() :array;

    abstract protected function getWithsForAllQuery() :array;
}
