<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ResizeDirNotFoundException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        Log::error('Resize dir is empty');
        parent::report($exception);
    }
}
