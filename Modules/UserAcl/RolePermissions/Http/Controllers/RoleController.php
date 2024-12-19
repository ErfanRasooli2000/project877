<?php

namespace Modules\Acl\RolePermissions\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\updateRoleRequest;
use Modules\Acl\RolePermissions\Http\Resources\PermissionResource;
use Modules\Acl\RolePermissions\Http\Resources\RoleListResource;
use Modules\Acl\RolePermissions\Http\Resources\RoleResource;
use Modules\Acl\RolePermissions\Services\RolePermissionService;
use Modules\Base\Traits\ApiResponse;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\JsonResponse;

class RoleController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected RolePermissionService $service
    ){}

    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/role-permissions/index",
     *     tags={"RolePermissions"},
     *     summary="List Of Roels",
     *     description="List Of Roels",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(property="meta", type="string", nullable=true, example=null)
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *     ),
     * )
     */
    public function index():JsonResponse
    {
        $roles = $this->service->roles();

        return $this->successResponse(RoleListResource::collection($roles));
    }

    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/role-permissions/create",
     *     tags={"RolePermissions"},
     *     summary="Create New Permission",
     *     description="Create New Permission",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "permissions"},
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(
     *                  property="permissions",
     *                  type="array",
     *                 @OA\Items(type="integer", example=1)
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(property="meta", type="string", nullable=true, example=null)
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *          @OA\JsonContent()
     *     ),
     * )
     */
    public function create(CreateRoleRequest $request):JsonResponse
    {
        $result = $this->service->create($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param Role $role
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/role-permissions/show/{id}",
     *     tags={"RolePermissions"},
     *     summary="Get Role With Permission",
     *     description="Get Role With Permission",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *       @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *        ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(property="meta", type="string", nullable=true, example=null)
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *          @OA\JsonContent()
     *     ),
     * )
     */
    public function show(Role $role):JsonResponse
    {
        $role = $this->service->show($role);

        return $this->successResponse(RoleResource::collection($role));
    }


    /**
     * @param Role $role
     * @param updateRoleRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Put(
     *     path="/api/v1/role-permissions/update/{id}",
     *     tags={"RolePermissions"},
     *     summary="Create New Role With Permission",
     *     description="Create New Role With Permission",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *       @OA\Parameter (
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *        ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name", "permissions"},
     *              @OA\Property(property="name", type="string", example="name"),
     *              @OA\Property(
     *                  property="permissions",
     *                  type="array",
     *                 @OA\Items(type="integer", example=1)
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(property="meta", type="string", nullable=true, example=null)
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *          @OA\JsonContent()
     *     ),
     * )
     */
    public function update(Role $role , updateRoleRequest $request):JsonResponse
    {
        $result = $this->service->update($role,$request->validated());

        return $this->resultResponse($result);
    }

    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/role-permissions/permissions",
     *     tags={"RolePermissions"},
     *     summary="Get Permission",
     *     description="Get Permission",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example=""),
     *             @OA\Property(property="meta", type="string", nullable=true, example=null)
     *         )
     *     ),
     *     @OA\Response(
     *          response=422,
     *          description="Validation Error",
     *          @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *          @OA\JsonContent()
     *     ),
     * )
     */
    public function permissions() :JsonResponse
    {
        $result = $this->service->permissions();

        return $this->successResponse(PermissionResource::collection($result));
    }
}
