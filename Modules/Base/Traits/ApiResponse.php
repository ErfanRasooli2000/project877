<?php

namespace Modules\Base\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param int $status
     * @param $message
     * @param $meta
     * @return JsonResponse
     */
    public function successResponse($data = null, int $status = 200, $message = null , $meta = null): JsonResponse
    {
        return response()->json([
            'status' => true,
            "data" => $data,
            "message" => $message,
            "meta" => $meta,
        ], $status);
    }

    /**
     * for return error response
     * @param null $message
     * @param int $status
     * @param null $data
     * @param null $meta
     * @return JsonResponse
     */
    public function errorResponse($message = null, int $status = 400, $data = null , $meta = null): JsonResponse
    {
        return response()->json([
            'status' => false,
            "data" => $data,
            "message" => $message,
            "meta" => $meta,
        ], $status);
    }

    /**
     * @param array $result
     * @return JsonResponse
     */
    public function resultResponse(array $result) :JsonResponse
    {
        if ($result['status'])
        {
            return $this->successResponse(
                $result['data'] ?? null,
                $result['statusCode'] ?? 200,
                $result['message'] ?? null,
                $result['meta'] ?? null,
            );
        }
        else
        {
            return $this->errorResponse(
                $result['message'] ?? null,
                $result['statusCode'] ?? 400,
                $result['data'] ?? null,
                $result['meta'] ?? null,
            );
        }
    }

    /**
     * @param $result
     * @return JsonResponse
     */
    public function paginationResponse($result) :JsonResponse
    {
        return $this->successResponse(
            $result,
            200,
            null,
            $result->response()->getData()->meta
        );
    }
}
