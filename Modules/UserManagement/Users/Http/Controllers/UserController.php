<?php

namespace Modules\UserManagement\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Base\Traits\ApiResponse;
use Modules\UserManagement\Users\Http\Requests\UserCreateRequest;
use Modules\UserManagement\Users\Http\Requests\UserUpdateRequest;
use Modules\UserManagement\Users\Models\User;
use Modules\UserManagement\Users\Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected UserService $service
    ){}

    public function index() :JsonResponse
    {
        Gate::authorize('viewAll');
    }

    public function indexTrash() :JsonResponse
    {
        Gate::authorize('viewTrashed');
    }

    public function export() :StreamedResponse
    {
        Gate::authorize('exportAll');
    }

    public function show(User $user) :JsonResponse
    {
        Gate::authorize('view' , $user);
    }

    public function create(UserCreateRequest $request) :JsonResponse
    {
        Gate::authorize('create');
    }

    public function update(User $user , UserUpdateRequest $request) :JsonResponse
    {
        Gate::authorize('update' , $user);
    }

    public function delete(User $user) :JsonResponse
    {
        Gate::authorize('delete' , $user);
    }

    public function restore($id) :JsonResponse
    {
        Gate::authorize('restore');
    }
}
