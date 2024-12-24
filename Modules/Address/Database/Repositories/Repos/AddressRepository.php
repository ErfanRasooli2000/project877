<?php

namespace Modules\Address\Database\Repositories\Repos;

use Modules\Address\Database\Repositories\Contracts\AddressRepositoryInterface;
use Modules\Address\Models\Address;
use Modules\Base\Repositories\Repos\BaseWithAllQueriesRepository;

class AddressRepository extends BaseWithAllQueriesRepository implements AddressRepositoryInterface
{
    public function __construct(
        protected Address $address
    ){}
}
