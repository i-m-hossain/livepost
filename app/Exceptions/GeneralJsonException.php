<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralJsonException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        
    }

    /**
     * Render the exception as an HTTP response.
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([ 
            "errors" =>[
                "message" => $this->message
            ]
        ], $this->getCode());
    }
}
