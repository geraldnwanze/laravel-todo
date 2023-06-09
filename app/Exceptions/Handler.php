<?php

namespace App\Exceptions;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Instanceof_;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e)
    {
            $this->exceptionLogger($request, $e);

            if ($e instanceof QueryException) {
                return back()->with('error', 'something went wrong');
            }

            if ($e instanceof TokenMismatchException) {
                return back()->with('error', 'something went wrong')->withInput();
            }

            if ($e instanceof ValidationException) {
                if ($request->expectsJson()) {
                    return $this->error($e->validator->getMessageBag()->all(), $e->status);
                }
                return back()->withErrors($e->validator->getMessageBag()->all())->withInput();
            }
    }

    public function exceptionLogger($request, Throwable $e)
    {
        $exceptionClass = class_basename($e);
        $message = $e instanceof ValidationException ? $e->validator->getMessageBag()->all() : $e->getMessage();
        $route = $request->route()->uri;
        $action = $request->route()->action;

        Log::error('Error on your app', [
            'ExceptionClass' => $exceptionClass,
            'message' => $message,
            'route' => $route,
            'action' => $action,
        ]);
    }

}
