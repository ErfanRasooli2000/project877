<?php

namespace Modules\User\UserAcl\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Base\Traits\ApiResponse;
use Modules\User\UserAcl\Auth\Http\Requests\LoginUserGetOtpRequest;
use Modules\User\UserAcl\Auth\Http\Requests\LoginUserRequest;
use Modules\User\UserAcl\Auth\Http\Requests\RegisterUserGetOtpRequest;
use Modules\User\UserAcl\Auth\Http\Requests\RegisterUserRequest;
use Modules\User\UserAcl\Auth\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected AuthService $service
    ){}

    /**
     * @param LoginUserGetOtpRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/users/authentication/send-otp-code",
     *     tags={"User - Authentication"},
     *     summary="Send Login Code",
     *     description="Send Login Code",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", default="application/json"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone_number"},
     *             @OA\Property(property="phone_number" , type="string" , example="09036583793"),
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="meta", type="string", nullable=true, example=null)
     *          )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *      ),
     *      @OA\Response(
     *           response=401,
     *           description="Authorization Error",
     *      ),
     * )
     */
    public function sendOtpCode(LoginUserGetOtpRequest $request) :JsonResponse
    {
        $result = $this->service->sendOtpCode($request->validated()['phone_number']);

        return $this->resultResponse($result);
    }

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/users/authentication/login",
     *     tags={"User - Authentication"},
     *     summary="login User",
     *     description="login User",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", default="application/json"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone_number","otp"},
     *             @OA\Property(property="phone_number" , type="string" , example="09036583793"),
     *             @OA\Property(property="otp" , type="string" , example="123654"),
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="meta", type="string", nullable=true, example=null)
     *          )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *      ),
     *      @OA\Response(
     *           response=401,
     *           description="Authorization Error",
     *      ),
     * )
     */
    public function login(LoginUserRequest $request) :JsonResponse
    {
        $result = $this->service->login($request->validated());

        return $this->resultResponse($result);
    }



    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/users/authentication/register",
     *     tags={"User - Authentication"},
     *     summary="Register User",
     *     description="Register User",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", default="application/json"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone_number","otp","first_name","last_name","city_id","province_id","address"},
     *             @OA\Property(property="phone_number" , type="string" , example="09036583793"),
     *             @OA\Property(property="otp" , type="string" , example="123654"),
     *             @OA\Property(property="first_name" , type="string" , example="erfan"),
     *             @OA\Property(property="last_name" , type="string" , example="rasooli"),
     *             @OA\Property(property="city_id" , type="string" , example="1"),
     *             @OA\Property(property="province_id" , type="string" , example="1"),
     *             @OA\Property(property="address" , type="string" , example="some where around us"),
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="meta", type="string", nullable=true, example=null)
     *          )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *      ),
     *      @OA\Response(
     *           response=401,
     *           description="Authorization Error",
     *      ),
     * )
     */
    public function register(RegisterUserRequest $request) :JsonResponse
    {
        $result = $this->service->register($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/users/authentication/logout",
     *     tags={"User - Authentication"},
     *     summary="Logout User",
     *     description="Logout User",
     *     security={ {"sanctum": {} }},
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", default="application/json"),
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example=""),
     *              @OA\Property(property="meta", type="string", nullable=true, example=null)
     *          )
     *      ),
     *      @OA\Response(
     *           response=422,
     *           description="Validation Error",
     *      ),
     *      @OA\Response(
     *           response=401,
     *           description="Authorization Error",
     *      ),
     * )
     */
    public function logout() :JsonResponse
    {
        $result = $this->service->logout();

        return $this->resultResponse($result);
    }
}
