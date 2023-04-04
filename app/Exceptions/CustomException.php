<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @property CustomException $code
 */

class CustomException extends Exception
{
    protected $code;

    public function render(Throwable $e)
    {
        if ($e instanceof TokenMismatchException) {
            return redirect('https://google.com');
        }
    }

    public function TokenMismatchException()
    {
        abort(419, 'ya mad');
    }
}
