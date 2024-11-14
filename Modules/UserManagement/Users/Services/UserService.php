<?php

namespace Modules\UserManagement\Users\Services;

use Modules\Base\Services\BaseWithAllQueriesService;
use Modules\UserManagement\Users\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\UserManagement\Users\Models\User;

class UserService extends BaseWithAllQueriesService
{
    private $className;

    public function __construct(
        protected UserRepositoryInterface $repository,
    ){
        $this->className = __('classNames.user');
    }

    protected function getFiltersForALlQuery(): array
    {
        return $this->requestFilter([
            'id',
            'first_name',
            'last_name',
            'phone_number',
        ]);
    }

    protected function getWithsForAllQuery(): array
    {
        return [];
    }

    public function show(User $user) :User
    {
        return $user;
    }

    public function create(array $inputs) :array
    {
        $this->repository->create($inputs);

        return [
            'status' => true,
            'message' => __('base.created', ['attribute' => $this->className]),
        ];
    }

    public function update(User $user , array $inputs) :array
    {
        $user->update($inputs);

        return [
            'status' => true,
            'message' => __('base.updated', ['attribute' => $this->className]),
        ];
    }

    public function delete(User $user) :array
    {
        $user->delete();

        return [
            'status' => true,
            'message' => __('base.deleted', ['attribute' => $this->className]),
        ];
    }

    public function restore(int $id) :array
    {
        $this->repository->restore($id);

        return [
            'status' => true,
            'message' => __('base.restored', ['attribute' => $this->className]),
        ];
    }
}
