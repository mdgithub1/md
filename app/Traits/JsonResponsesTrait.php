<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Trait JsonResponsesTrait
 * To create responses following standards included in jsonapi.org specification:
 * @link https://jsonapi.org/format/
 * @package App\Traits
 */
trait JsonResponsesTrait
{
    /**
     * Return the error json response
     *
     * @link https://jsonapi.org/format/#errors
     * @param string|array $message Error message(s)
     * @param int          $status  HTTP status
     * @param array        $source  Request target
     * @return JsonResponse
     */
    public function jsonError(string|array $message, int $status=400, array $source=[]): JsonResponse
    {
        $source['pointer'] = request()->getPathInfo();
        $source['method'] = request()->getMethod();

        return response()
            ->json()
            ->setStatusCode(code: $status)
            ->setData(data:
                ["errors" =>
                    [
                        [
                            'status' => $status,
                            'title'  => JsonResponse::$statusTexts[$status],
                            'detail' => $message,
                            'source' => $source,
                        ],
                    ],
                ]
            )
            ->header(key: 'Content-Type', values: 'application/json');
    }

    /**
     * Return success message | Confirmation
     *
     * @param string $message Text message
     * @param int $status     HTTP status; must be 200 >=< 299
     * @return JsonResponse
     */
    public function jsonSuccess(string $message = 'OK', int $status = 200): JsonResponse
    {
        return response()
            ->json()
            ->setStatusCode(code: $status, text: Response::$statusTexts[$status])
            ->setData(data: ["message" => $message])
            ->header(key: 'Content-Type', values: 'application/json');
    }
}
