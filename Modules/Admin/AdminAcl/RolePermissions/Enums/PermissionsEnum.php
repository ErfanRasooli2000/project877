<?php

namespace Modules\Admin\AdminAcl\RolePermissions\Enums;

use Modules\Base\Traits\BaseEnumTrait;

enum PermissionsEnum :string
{
    use BaseEnumTrait;

    // Admin Module Permissions
    case View_Admins = 'view-admins';
    case View_Trashed_Admins = 'view-trashed-admins';
    case Export_Admins = 'export-admins';
    case Create_Admin = 'create-admin';
    case Edit_Admin = 'edit-admin';
    case Delete_Admin = 'delete-admin';
    case Restore_Admin = 'restore-admin';
}
