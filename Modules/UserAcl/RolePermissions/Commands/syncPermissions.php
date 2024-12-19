<?php

namespace Modules\Acl\RolePermissions\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Modules\Acl\RolePermissions\Enums\PermissionsEnum;
use Spatie\Permission\Models\Permission;

class syncPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync permissions from enums';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $permissions = PermissionsEnum::values();

        $existedPermissions = Permission::select('name')->pluck('name')->toArray();

        $newPermissions = array_diff($permissions, $existedPermissions);

        foreach ($newPermissions as $permission) {
            Permission::create(['name' => $permission ,'guard_name' => 'sanctum']);
        }

        Cache::put('permissions_for_select', Permission::query()
            ->select('id' , 'name')
            ->get());
    }
}
