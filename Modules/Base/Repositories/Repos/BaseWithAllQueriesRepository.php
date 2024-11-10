<?php

namespace Modules\Base\Repositories\Repos;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Base\Repositories\Contracts\BaseWithAllQueriesRepositoryInterface;

class BaseWithAllQueriesRepository extends BaseRepository implements BaseWithAllQueriesRepositoryInterface
{
    public function getAllWithPagination(array $filters = [], array $with = []): LengthAwarePaginator
    {
        $query = $this->filters($filters);

        return $query->with($with)
            ->sortIndex($filters['sort'])
            ->paginate($filters['per_page']);
    }

    public function getAll(array $filters = [], array $with = []): Collection
    {
        $query = $this->filters($filters);

        return $query->with($with)->get();
    }
}
