<?php

namespace Modules\UserManagement\Users\Database\Repositories\Repos;

use Modules\Base\Repositories\Repos\BaseWithAllQueriesRepository;
use Modules\UserManagement\Users\Database\Repositories\Contracts\UserRepositoryInterface;
use Modules\UserManagement\Users\Models\User;

class UserRepository extends BaseWithAllQueriesRepository implements UserRepositoryInterface
{
    public function __construct(
        protected User $model
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
