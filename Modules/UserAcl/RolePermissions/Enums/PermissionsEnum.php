<?php

namespace Modules\Acl\RolePermissions\Enums;

use Modules\Base\Traits\BaseEnumTrait;

enum PermissionsEnum :string
{
    use BaseEnumTrait;

    // User Module Permissions
    case View_Users = 'view-users';
    case View_Trashed_Users = 'view-trashed-users';
    case Export_Users = 'export-users';
    case Create_User = 'create-user';
    case Edit_User = 'edit-user';
    case Delete_User = 'delete-user';
    case Restore_User = 'restore-user';
}
