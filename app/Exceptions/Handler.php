<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
  /**
   * A list of the exception types that are not reported.
   *
   * @var array
   */
  protected $dontReport = [
    //
  ];

  /**
   * A list of the inputs that are never flashed for validation exceptions.
   *
   * @var array
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

  public function render($request, Throwable $exception)
  {
    if ($exception instanceof ModelNotFoundException) { //  && $request->wantsJson()
      return response(
        [
          'message' => "record not found in " .
            strtolower(class_basename($exception->getModel())) . " model"
          // "description" => $exception->getMessage()
        ],
        404
      );
    }

    if ($exception instanceof NotFoundHttpException) { //  && $request->wantsJson()
      return response(
        [
          'message' => "route not found"
        ],
        404
      );
    }

    if ($exception instanceof ValidationException) {
      return response(
        [
          'message' => "invalid data",
          "description" => $exception->getMessage(),
          "detail" => $exception->errors()
        ],
        422
      );
    }

    if ($exception instanceof AuthenticationException) {
      return response(
        [
          'message' => "unauthenticated",
        ],
        401
      );
    }

    if ($exception instanceof AuthorizationException) {
      return response(
        [
          'message' => "unauthorized",
          "description" => $exception->getMessage(),
        ],
        403
      );
    }


    if ($exception instanceof MethodNotAllowedHttpException) {
      return response(
        [
          'message' => $exception->getMessage(),
        ],
        405
      );
    }

    if ($exception instanceof HttpException) {
      return response(
        [
          'message' => $exception->getMessage(),
        ],
        $exception->getStatusCode()
      );
    }

    if ($exception instanceof QueryException) {
      $error_code = $exception->errorInfo[1];
      if ($error_code == 1451) {
        return response(
          [
            'message' => "can not delete record due to foreign key constraints"
          ],
          409
        );
      }

      if ($error_code == 1062) {
        return response(
          [
            'message' => "duplicate entry"
          ],
          409
        );
      }
    }

    if (config('app.debug')) {
      // return $this->errorResponse(
      //   [
      //     'message' => "internal server error",
      //     'description' => $exception->getMessage()
      //   ],
      //   500
      // );
      return parent::render($request, $exception);
    }

    return response(
      [
        'message' => "internal server error",
        'description' => $exception->getMessage()
      ],
      500
    );
  }
}
