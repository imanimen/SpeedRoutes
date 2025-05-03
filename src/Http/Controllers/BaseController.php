<?php

namespace Imanimen\SpeedRoutes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public function route(Request $request, $action): Response|View
    {
        $class_action = 'App\\Actions\\' . ucfirst($action) . 'Action';
        if (!class_exists($class_action)) {
            return $this->responseFacotry([], 'not found', [], Response::HTTP_NOT_FOUND);
        }
        $class = (new $class_action());
        if ($class->method() !== $request->method()) {
            return $this->responseFacotry([], 'invalid method', [], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $validaton = Validator::make($request->all(), $class->validation());
        if ($validaton->fails()) {
            return $this->responseFacotry([], $validaton->errors(), $this->validationMessages($validaton->errors()), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $mannerPath = $class->getManner();
        foreach ($mannerPath as $manner) {
            if ($manner) {
                if (!class_exists($manner)) {
                    return $this->responseFacotry([], 'manner not found', [], Response::HTTP_NOT_FOUND);
                } else {
                    $mannerMain = (new $manner());
                    if ($mannerMain->check($request)) {
                        $response = $class->render();
                        if ($response instanceof View) {
                            return $response;
                        } else {
                            return $this->responseFacotry($response);
                        }
                    } else {
                        return $this->responseFacotry([], $mannerMain->errorMessage(), [], $mannerMain->errorCode());
                    }
                }
            }
        }
        $response = $class->render();
        if ($response instanceof View) {
            return $response;
        } else {
            return $this->responseFacotry($response);
        }
    }

    public function validationMessages($errors): array
    {
        $messages = [];

        foreach ($errors as $error) {
            foreach ($error as $message) {
                $messages[] = $message;
            }
        }

        return $messages;
    }

    public function success($data = [], $message = [], $errors = [], $code = Response::HTTP_OK): Response
    {
        return $this->responseFacotry($data, $message, $errors, $code);
    }

    public function fail($data = [], $message = [], $errors = [], $code = Response::HTTP_UNPROCESSABLE_ENTITY): Response
    {
        return $this->responseFacotry($data, $message, $errors, $code);
    }

    public function responseFacotry($data = [], $errors = [], $message = [], int $code = Response::HTTP_UNPROCESSABLE_ENTITY): Response
    {
        return response()->make([
            'data' => $data,
            'errors' => $errors,
            'messages' => $message,
            'code' => $code,
        ])->setStatusCode($code);
    }
}
