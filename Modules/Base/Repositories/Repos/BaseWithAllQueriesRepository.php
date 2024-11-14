<?php

namespace Modules\Base\Repositories\Repos;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Base\Repositories\Contracts\BaseWithAllQueriesRepositoryInterface;

class BaseWithAllQueriesRepository extends BaseRepository implements BaseWithAllQueriesRepositoryInterface
{
    public function getAllWithPagination(array $filters = [], array $with = [] , bool $trashed = false): LengthAwarePaginator
    {
        $query = $this->filters($filters);

        return $query->with($with)
            ->when($trashed , function ($q){
                $q->onlyTrashed();
            })
            ->sortIndex($filters['sort'])
            ->paginate($filters['per_page']);
    }

    public function getAll(array $filters = [], array $with = [] , bool $trashed = false): Collection
    {
        return $this->filters($filters)
            ->when($trashed , function ($q){
                $q->onlyTrashed();
            })
            ->with($with)
            ->get();
    }
}
