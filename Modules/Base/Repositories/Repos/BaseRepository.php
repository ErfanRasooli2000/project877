<?php

namespace Modules\Base\Repositories\Repos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Modules\Base\Repositories\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    public function getByIds(array $ids): Collection
    {
        return $this->model
            ->newQuery()
            ->whereIn('id', $ids)
            ->get();
    }

    public function create(array $attributes): Model
    {
        return $this->model
            ->newQuery()
            ->create($attributes);
    }

    public function insert(array $data): int
    {
        return $this->model
            ->newQuery()
            ->insert($data);
    }

    public function restore($id)
    {
        return $this->model
            ->newQuery()
            ->withTrashed()
            ->whereId($id)
            ->restore();
    }

    public function findById($id): mixed
    {
        return $this->model
            ->newQuery()
            ->findOrFail($id);
    }

    public function findByIdWithTrashed($id): mixed
    {
        return $this->model
            ->newQuery()
            ->withTrashed()
            ->findOrFail($id);
    }

    public function findByFieldOrFail(string $field, $value): mixed
    {
        return $this->model
            ->newQuery()
            ->where($field, $value)
            ->firstOrFail();
    }

    public function findByField(string $field, $value): mixed
    {
        return $this->model
            ->newQuery()
            ->where($field, $value)
            ->first();
    }


    public function delete(Model $model): bool
    {
        return $model
            ->delete();
    }

    public function getAllWithSelect(array $selects , string $sortColumn = 'id' , string $sortType = 'asc' , array $withs = []): Collection
    {
        return $this->model
            ->newQuery()
            ->select($selects)
            ->with($withs)
            ->orderBy($sortColumn, $sortType)
            ->get();
    }
}
