<?php

namespace Modules\Acl\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Acl\Auth\Http\Requests\LoginUserGetOtpRequest;
use Modules\Acl\Auth\Http\Requests\LoginUserRequest;
use Modules\Acl\Auth\Http\Requests\RegisterUserGetOtpRequest;
use Modules\Acl\Auth\Http\Requests\RegisterUserRequest;
use Modules\Acl\Auth\Services\AuthService;
use Modules\Base\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function __construct(
        protected AuthService $service
    ){}


    /**
     * @param RegisterUserGetOtpRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/authentication/register-get-otp",
     *     tags={"Authentication"},
     *     summary="Register Send Code",
     *     description="Register Send Code",
     *     @OA\Parameter(
     *         name="Accept",
     *         in="header",
     *         required=true,
     *         @OA\Schema(type="string", default="application/json"),
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"phone_number","first_name","last_name"},
     *             @OA\Property(property="phone_number" , type="string" , example="09036583793"),
     *             @OA\Property(property="first_name" , type="string" , example="نام"),
     *             @OA\Property(property="last_name" , type="string" , example="نام خانوادگی"),
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
    public function registerGetOtp(RegisterUserGetOtpRequest $request) :JsonResponse
    {
        $result = $this->service->sendRegisterLoginCode($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/authentication/register",
     *     tags={"Authentication"},
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
    public function register(RegisterUserRequest $request) :JsonResponse
    {
        $result = $this->service->register($request->validated());

        return $this->resultResponse($result);
    }


    /**
     * @param LoginUserGetOtpRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/authentication/send-login-code",
     *     tags={"Authentication"},
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
    public function sendLoginCode(LoginUserGetOtpRequest $request) :JsonResponse
    {
        $result = $this->service->sendLoginCode($request->validated()['phone_number']);

        return $this->resultResponse($result);
    }


    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/authentication/login",
     *     tags={"Authentication"},
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
     * @return JsonResponse
     *
     *
     * @OA\Post(
     *     path="/api/v1/authentication/logout",
     *     tags={"Authentication"},
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