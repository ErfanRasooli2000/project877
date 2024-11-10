<?php

namespace Modules\UserManagement\Users\Policies;

use Modules\Acl\RolePermissions\Enums\PermissionsEnum;
use Modules\UserManagement\Users\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAll(User $user): bool
    {
        return $user->can(PermissionsEnum::View_Users);
    }

    public function viewTrashed(User $user): bool
    {
        return $user->can(PermissionsEnum::View_Trashed_Users);
    }

    /**
     * Determine whether the user can view any models.
     */
    public function exportAll(User $user): bool
    {
        return $user->can(PermissionsEnum::Export_Users);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::Edit_User);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::Create_User);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::Edit_User);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::Delete_User);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->can(PermissionsEnum::Restore_User);
    }
}
