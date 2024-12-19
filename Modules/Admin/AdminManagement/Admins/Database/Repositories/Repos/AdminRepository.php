<?php

namespace Modules\Admin\AdminManagement\Admins\Database\Repositories\Repos;

use Modules\Admin\AdminManagement\Admins\Database\Repositories\Contracts\AdminRepositoryInterface;
use Modules\Admin\AdminManagement\Admins\Models\Admin;
use Modules\Base\Repositories\Repos\BaseWithAllQueriesRepository;

class AdminRepository extends BaseWithAllQueriesRepository implements AdminRepositoryInterface
{
    public function __construct(
        protected Admin $model
    ){}

    public function filters(array $filters)
    {
        return $this->model
            ->newQuery()
            ->when($filters['id'],function ($query,$value){
                $query->whereId($value);
            })
            ->when($filters['first_name'],function ($query , $value){
                $query->where('first_name','like','%'.$value.'%');
            })
            ->when($filters['last_name'],function ($query , $value){
                $query->where('last_name','like','%'.$value.'%');
            })
            ->when($filters['phone_number'],function ($query , $value){
                $query->where('phone_number','like','%'.$value.'%');
            });
    }
}
