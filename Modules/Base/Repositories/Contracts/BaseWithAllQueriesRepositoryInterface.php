<?php

namespace Modules\Base\Repositories\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseWithAllQueriesRepositoryInterface extends BaseRepositoryInterface
{
    public function getAllWithPagination(array $filters = [] , array $with = []): LengthAwarePaginator;
    public function getAll(array $filters = [] , array $with = []): Collection;
}
