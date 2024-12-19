<?php

namespace Modules\Admin\AdminManagement\Admins\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Admin\AdminManagement\Admins\Http\Requests\AdminCreateRequest;
use Modules\Admin\AdminManagement\Admins\Http\Requests\AdminUpdateRequest;
use Modules\Admin\AdminManagement\Admins\Http\Resources\AdminsExportResource;
use Modules\Admin\AdminManagement\Admins\Http\Resources\AdminsListResource;
use Modules\Admin\AdminManagement\Admins\Http\Resources\AdminsResource;
use Modules\Admin\AdminManagement\Admins\Models\Admin;
use Modules\Admin\AdminManagement\Admins\Services\AdminService;
use Modules\Base\Services\ExportService;
use Modules\Base\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected AdminService $service
    ){}


    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/admins/index",
     *     tags={"Admins"},
     *     summary="List Of Admins",
     *     description="List Of Admins",
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

        return $this->paginationResponse(AdminsListResource::collection($result));
    }


    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/admins/index-trash",
     *     tags={"Admins"},
     *     summary="List Of Trashed Admins",
     *     description="List Of Trashed Admins",
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

        return $this->paginationResponse(AdminsListResource::collection($result));
    }


    /**
     * @return StreamedResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/admins/export",
     *     tags={"Admins"},
     *     summary="Exports List Of Admins",
     *     description="Exports List Of Admins.",
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

        return app(ExportService::class)->download($result , AdminsExportResource::class , 'admins.xlsx');
    }


    /**
     * @param Admin $admin
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/admins/show/{id}",
     *     tags={"Admins"},
     *     summary="show The Admin",
     *     description="show The Admin",
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
    public function show(Admin $admin) :JsonResponse
    {
        Gate::authorize('view' , $admin);

        $admin = $this->service->show($admin);

        return $this->successResponse(new AdminsResource($admin));
    }


    /**
     * @param AdminCreateRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/admins/create",
     *     tags={"Admins"},
     *     summary="Create New Admin",
     *     description="Create New Admin",
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
    public function create(AdminCreateRequest $request) :JsonResponse
    {
        Gate::authorize('create');

        $result = $this->service->create($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param Admin $admin
     * @param AdminUpdateRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Put(
     *     path="/api/v1/admins/update/{id}",
     *     tags={"Admins"},
     *     summary="Update The Admin",
     *     description="Update The Admin",
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
    public function update(Admin $admin , AdminUpdateRequest $request) :JsonResponse
    {
        Gate::authorize('update' , $admin);

        $result = $this->service->update($admin , $request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param Admin $admin
     * @return JsonResponse
     *
     *
     * @OA\Delete(
     *     path="/api/v1/admins/delete/{id}",
     *     tags={"Admins"},
     *     summary="Delete The Admin",
     *     description="Delete The Admin",
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
    public function delete(Admin $admin) :JsonResponse
    {
        Gate::authorize('delete' , $admin);

        $result = $this->service->delete($admin);

        return $this->resultResponse($result);
    }


    /**
     * @param $id
     * @return JsonResponse
     *
     *
     * @OA\Post (
     *     path="/api/v1/admins/restore/{id}",
     *     tags={"Admins"},
     *     summary="Restore The Admin",
     *     description="Restore The Admin",
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
