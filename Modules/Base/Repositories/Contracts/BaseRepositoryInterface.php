<?php

namespace Modules\Base\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function create(array $inputs) :Model;
    public function insert(array $data): int;
    public function findById($id) :mixed;
    public function findByIdWithTrashed($id) :mixed;
    public function getByIds(array $ids): Collection;
    public function delete(Model $model): bool;
    public function findByFieldOrFail(string $field, $value): mixed;
    public function findByField(string $field, $value): mixed;
    public function getAllWithSelect(array $selects , string $sortColumn = 'id' , string $sortType = 'asc' , array $withs = []) :Collection;
}
