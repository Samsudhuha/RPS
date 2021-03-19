<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function handleException(Exception $e): JsonResponse
    {
        Log::error($e);

        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
            if (!$message = $e->getMessage()) {
                $message = Response::$statusTexts[$code];
            }

            return $this->sendError($message, 'Error', $code);
        }

        if ($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));

            return $this->sendError("{$model} not found", 'Error', Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof AuthorizationException) {
            return $this->sendError($e->getMessage(), Response::HTTP_FORBIDDEN);
        }

        if ($e instanceof AuthenticationException) {
            return $this->sendError($e->getMessage(), 'Error', Response::HTTP_UNAUTHORIZED);
        }

        if ($e instanceof ValidationException) {
            $errors = $e->validator->errors()->getMessages();

            return $this->sendError($errors, 'Error', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (env('APP_DEBUG')) {
            return $this->sendError($e->getMessage(), 'Error', 500);
        }

        return $this->sendError('Unexpected error. Try again later.', 'Error', 500);
    }
}
