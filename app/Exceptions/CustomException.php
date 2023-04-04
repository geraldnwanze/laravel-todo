<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @property CustomException $code
 */

class CustomException extends Exception
{
    protected $instance, $class, $statusCode, $message;

    public function __construct(Throwable $e)
    {
        $this->instance = $e->getPrevious();
        $this->class = get_class($this->instance);
        $this->statusCode = $e->getStatusCode();
        $this->message = $e->getMessage();
    }

    public function logToFile()
    {
        Log::error('exception', ['class' => $this->class, 'statusCode' => $this->statusCode, 'message' => $this->message]);
    }

    public function render()
    {
        $this->logToFile();

        return back()->with('error', 'something went wrong');
    }

}
