<?php

namespace Modules\UserManagement\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Base\Services\ExportService;
use Modules\Base\Traits\ApiResponse;
use Modules\UserManagement\Users\Http\Requests\UserCreateRequest;
use Modules\UserManagement\Users\Http\Requests\UserUpdateRequest;
use Modules\UserManagement\Users\Http\Resources\UsersExportResource;
use Modules\UserManagement\Users\Http\Resources\UsersListResource;
use Modules\UserManagement\Users\Http\Resources\UsersResource;
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


    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/users/index",
     *     tags={"Users"},
     *     summary="List Of Users",
     *     description="List Of Users",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *      @OA\Parameter (
     *         name="id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="first_name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="last_name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="phone_number",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *          name="per_page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string" , example="10"),
     *       ),
     *      @OA\Parameter (
     *          name="page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string" , example="1"),
     *       ),
     *      @OA\Parameter(
     *          name="sort[column]",
     *          in="query",
     *          description="The column to sort by (e.g., 'id', 'name', etc.)",
     *          required=false,
     *          example="id"
     *      ),
     *      @OA\Parameter(
     *          name="sort[order]",
     *          in="query",
     *          description="The sort order, either 'asc' for ascending or 'desc' for descending",
     *          required=false,
     *          example="asc"
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
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *     ),
     * )
     */
    public function index() :JsonResponse
    {
        Gate::authorize('viewAll');

        $result = $this->service->getAllWithPagination();

        return $this->paginationResponse(UsersListResource::collection($result));
    }


    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/users/index-trash",
     *     tags={"Users"},
     *     summary="List Of Trashed Users",
     *     description="List Of Trashed Users",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *      @OA\Parameter (
     *         name="id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="first_name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="last_name",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *         name="phone_number",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *      ),
     *      @OA\Parameter (
     *          name="per_page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string" , example="10"),
     *       ),
     *      @OA\Parameter (
     *          name="page",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string" , example="1"),
     *       ),
     *      @OA\Parameter(
     *          name="sort[column]",
     *          in="query",
     *          description="The column to sort by (e.g., 'id', 'name', etc.)",
     *          required=false,
     *          example="id"
     *      ),
     *      @OA\Parameter(
     *          name="sort[order]",
     *          in="query",
     *          description="The sort order, either 'asc' for ascending or 'desc' for descending",
     *          required=false,
     *          example="asc"
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
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Authorization Error",
     *     ),
     * )
     */
    public function indexTrash() :JsonResponse
    {
        Gate::authorize('viewTrashed');

        $result = $this->service->getAllWithPagination(true);

        return $this->paginationResponse(UsersListResource::collection($result));
    }


    /**
     * @return StreamedResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/users/export",
     *     tags={"Users"},
     *     summary="Exports List Of Users",
     *     description="Exports List Of Users.",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string", default="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"),
     *     ),
     *       @OA\Parameter (
     *          name="id",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string"),
     *       ),
     *       @OA\Parameter (
     *          name="first_name",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string"),
     *       ),
     *       @OA\Parameter (
     *          name="last_name",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string"),
     *       ),
     *       @OA\Parameter (
     *          name="phone_number",
     *          in="query",
     *          required=false,
     *          @OA\Schema(type="string"),
     *       ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             @OA\Schema(type="string", example="attachment; filename=voip_extensions.xlsx")
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *             @OA\Schema(type="string", format="binary")
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
     *     @OA\Response(
     *          response=500,
     *          description="Authorization Error",
     *          @OA\JsonContent()
     *     ),
     * )
     */
    public function export() :StreamedResponse
    {
        Gate::authorize('exportAll');

        $result = $this->service->getAllForExcel();

        return app(ExportService::class)->download($result , UsersExportResource::class , 'users.xlsx');
    }


    /**
     * @param User $user
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/users/show/{id}",
     *     tags={"Users"},
     *     summary="show The User",
     *     description="show The User",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *     @OA\Parameter (
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(type="integer"),
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
    public function show(User $user) :JsonResponse
    {
        Gate::authorize('view' , $user);

        $user = $this->service->show($user);

        return $this->successResponse(new UsersResource($user));
    }


    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/users/create",
     *     tags={"Users"},
     *     summary="Create New User",
     *     description="Create New User",
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
     *              required={"first_name", "last_name", "email", "phone_number"},
     *              @OA\Property(property="first_name", type="string", example="first_name"),
     *              @OA\Property(property="last_name", type="integer", example="last_name"),
     *              @OA\Property(property="email", type="integer", example="test@gmail.com"),
     *              @OA\Property(property="phone_number", type="integer", example="09035567987"),
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
    public function create(UserCreateRequest $request) :JsonResponse
    {
        Gate::authorize('create');

        $result = $this->service->create($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param User $user
     * @param UserUpdateRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Put(
     *     path="/api/v1/users/update/{id}",
     *     tags={"Users"},
     *     summary="Update The User",
     *     description="Update The User",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *      @OA\Parameter (
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *       ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"first_name", "last_name", "email", "phone_number"},
     *              @OA\Property(property="first_name", type="string", example="first_name"),
     *              @OA\Property(property="last_name", type="integer", example="last_name"),
     *              @OA\Property(property="email", type="integer", example="test@gmail.com"),
     *              @OA\Property(property="phone_number", type="integer", example="09035567987"),
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
    public function update(User $user , UserUpdateRequest $request) :JsonResponse
    {
        Gate::authorize('update' , $user);

        $result = $this->service->update($user , $request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param User $user
     * @return JsonResponse
     *
     *
     * @OA\Delete(
     *     path="/api/v1/users/delete/{id}",
     *     tags={"Users"},
     *     summary="Delete The User",
     *     description="Delete The User",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *     @OA\Parameter (
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(type="integer"),
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
    public function delete(User $user) :JsonResponse
    {
        Gate::authorize('delete' , $user);

        $result = $this->service->delete($user);

        return $this->resultResponse($result);
    }


    /**
     * @param $id
     * @return JsonResponse
     *
     *
     * @OA\Post (
     *     path="/api/v1/users/restore/{id}",
     *     tags={"Users"},
     *     summary="Restore The User",
     *     description="Restore The User",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter (
     *        name="Accept",
     *        in="header",
     *        required=true,
     *        @OA\Schema(type="string" , default="application/json"),
     *     ),
     *     @OA\Parameter (
     *        name="id",
     *        in="path",
     *        required=true,
     *        @OA\Schema(type="integer"),
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
    public function restore($id) :JsonResponse
    {
        Gate::authorize('restore');

        $result = $this->service->restore($id);

        return $this->resultResponse($result);
    }
}
