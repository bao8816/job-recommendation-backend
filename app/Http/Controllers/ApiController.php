<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    const STATUS_CODE_SUCCESS = 200;
    const STATUS_CODE_CREATED = 201;
    const STATUS_CODE_NO_CONTENT = 204;
    const STATUS_CODE_BAD_REQUEST = 400;
    const STATUS_CODE_UNAUTHORIZED = 401;
    const STATUS_CODE_FORBIDDEN = 403;
    const STATUS_CODE_NOT_FOUND = 404;
    const STATUS_CODE_METHOD_NOT_ALLOWED = 405;
    const STATUS_CODE_UNPROCESSABLE_ENTITY = 422;
    const STATUS_CODE_INTERNAL_SERVER_ERROR = 500;

    protected $statusCode = 200;

    public function __construct()
    {
        $this->statusCode = 200;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode): static
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respondWithData($data, $message): JsonResponse
    {
        $res = [
            'error'         => false,
            'message'       => $message,
            'data'          => $data,
            'status_code'   => $this->getStatusCode()
        ];
        return response()->json($res, $this->getStatusCode());
    }

    public function respondWithError($message): JsonResponse
    {
        $res = [
            'error'         => true,
            'message'       => $message,
            'data'          => null,
            'status_code'   => $this->getStatusCode()
        ];

        return response()->json($res, $this->getStatusCode());
    }

    public function respondNotFound($message = 'Not Found'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_NOT_FOUND)->respondWithError($message);
    }

    public function respondInternalServerError($message = 'Internal Server Error'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    public function respondUnauthorized($message = 'Unauthorized'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_UNAUTHORIZED)->respondWithError($message);
    }

    public function respondForbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_FORBIDDEN)->respondWithError($message);
    }

    public function respondBadRequest($message = 'Bad Requests'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_BAD_REQUEST)->respondWithError($message);
    }

    public function respondCreated($data, $message = 'Created'): JsonResponse
    {
        return $this->setStatusCode(self::STATUS_CODE_CREATED)->respondWithData($data, $message);
    }
}
