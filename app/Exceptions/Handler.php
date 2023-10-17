<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
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
        if ($this->isHttpException($exception)) {
            return $this->renderHttpException($exception);
        }

        // Menambahkan penanganan untuk error 500
        // if ($exception instanceof \ErrorException) {
        //     return response()->view('content.errors.500', ['errorType' => 'Server Error'], 500);
        // }

        if ($exception instanceof AuthorizationException) {
          return response()->view('content.errors.403', ['errorType' => 'Izin Akses Ditolak'], 403);
      }

        return parent::render($request, $exception);
    }
}
