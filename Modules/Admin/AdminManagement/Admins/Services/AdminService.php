<?php

namespace Modules\Admin\AdminManagement\Admins\Services;

use Modules\Admin\AdminManagement\Admins\Database\Repositories\Contracts\AdminRepositoryInterface;
use Modules\Admin\AdminManagement\Admins\Models\Admin;
use Modules\Base\Services\BaseWithAllQueriesService;

class AdminService extends BaseWithAllQueriesService
{
    private $className;

    public function __construct(
        protected AdminRepositoryInterface $repository,
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

    public function show(Admin $admin) :Admin
    {
        return $admin;
    }

    public function create(array $inputs) :array
    {
        $this->repository->create($inputs);

        return [
            'status' => true,
            'message' => __('base.created', ['attribute' => $this->className]),
        ];
    }

    public function update(Admin $admin , array $inputs) :array
    {
        $admin->update($inputs);

        return [
            'status' => true,
            'message' => __('base.updated', ['attribute' => $this->className]),
        ];
    }

    public function delete(Admin $admin) :array
    {
        $admin->delete();

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
