<?php

namespace Modules\City\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Base\Http\Resources\selectResourceWithName;
use Modules\Base\Traits\ApiResponse;
use Modules\City\Services\ProvinceService;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProvinceController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected ProvinceService $service
    ){}

    /**
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/province-city/provinces",
     *     tags={"Province And Cities"},
     *     summary="show The Provinces",
     *     description="show The Provinces",
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
    public function getAll()
    {
        $provinces = $this->service->getALl();

        return $this->successResponse(selectResourceWithName::collection($provinces));
    }
}
