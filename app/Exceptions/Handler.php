<?php

namespace App\Exceptions;

use App\Traits\JsonResponsesTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Spatie\QueryBuilder\Exceptions\InvalidSortQuery;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use JsonResponsesTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response
     *
     * @inheritdoc
     */
    public function render($request, Throwable $e): JsonResponse | null
    {
        // MethodNotAllowedHttpException
        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->jsonError(
                message: $e->getMessage(),
                status: $e->getStatusCode(),
            );
        }

        // ModelNotFoundException
        if ($e instanceof ModelNotFoundException) {
            return $this->jsonError(
                message: "The resource does not exist.",
                status: 404,
            );
        }

        // NotFoundHttpException
        if ($e instanceof NotFoundHttpException) {
            return $this->jsonError(
                message: "The route does not exist for this request.",
                status: $e->getStatusCode(),
            );
        }

        // InvalidSortQuery
        if ($e instanceof InvalidSortQuery) {
            return $this->jsonError(
                message: $e->getMessage(),
                status: 422,
            );
        }

        // ValidationException
        if ($e instanceof ValidationException) {
            return $this->jsonError(
                message: $e->validator->getMessageBag()->toArray(),
                status:  422,
            );
        }

        // Handle other exceptions
        return $this->jsonError(
            message: $e->getMessage(),
        );
    }
}
