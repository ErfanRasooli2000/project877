<?php

namespace Modules\Admin\AdminManagement\Admins\Policies;

use Modules\Admin\AdminAcl\RolePermissions\Enums\PermissionsEnum;
use Modules\Admin\AdminManagement\Admins\Models\Admin;

class AdminPolicy
{
    /**
     * Determine whether the Admin can view any models.
     */
    public function viewAll(Admin $admin): bool
    {
        return $admin->can(PermissionsEnum::View_Admins);
    }

    public function viewTrashed(Admin $admin): bool
    {
        return $admin->can(PermissionsEnum::View_Trashed_Admins);
    }

    /**
     * Determine whether the Admin can view any models.
     */
    public function exportAll(Admin $admin): bool
    {
        return $admin->can(PermissionsEnum::Export_Admins);
    }

    /**
     * Determine whether the Admin can view the model.
     */
    public function view(Admin $admin, Admin $model): bool
    {
        return $admin->can(PermissionsEnum::Edit_Admin);
    }

    /**
     * Determine whether the Admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can(PermissionsEnum::Create_Admin);
    }

    /**
     * Determine whether the Admin can update the model.
     */
    public function update(Admin $admin, Admin $model): bool
    {
        return $admin->can(PermissionsEnum::Edit_Admin);
    }

    /**
     * Determine whether the Admin can delete the model.
     */
    public function delete(Admin $admin, Admin $model): bool
    {
        return $admin->can(PermissionsEnum::Delete_Admin);
    }

    /**
     * Determine whether the Admin can restore the model.
     */
    public function restore(Admin $admin): bool
    {
        return $admin->can(PermissionsEnum::Restore_Admin);
    }
}
