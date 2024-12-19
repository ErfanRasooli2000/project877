<?php

namespace Modules\City\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Base\Http\Resources\selectResourceWithName;
use Modules\Base\Traits\ApiResponse;
use Modules\City\Models\Province;
use Modules\City\Services\CityService;
use Symfony\Component\HttpFoundation\JsonResponse;

class CityController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected CityService $service
    ){}


    /**
     * @param Province $province
     * @return JsonResponse
     *
     *
     * @OA\Get(
     *     path="/api/v1/province-city/cities-in-province/{id}",
     *     tags={"Province And Cities"},
     *     summary="show The Cities in the Provinces",
     *     description="show The Cities in the Provinces",
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

    public function getCitiesByProvince(Province $province) :JsonResponse
    {
        $cities = $this->service->getCitiesByProvince($province);

        return $this->successResponse(selectResourceWithName::collection($cities));
    }
}
