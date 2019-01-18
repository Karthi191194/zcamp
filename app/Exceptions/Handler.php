<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException ;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException ;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   //JWT Method 2
        //https://medium.com/@hdcompany123/laravel-5-7-and-json-web-tokens-tymon-jwt-auth-d5af05c0659a
        if($exception instanceof TokenExpiredException  ){
            return response()->json('Token is Expired');
        }elseif($exception instanceof TokenInvalidException  ){
        return response()->json('Token is Invalid');
         }elseif($exception instanceof JWTException  ){
        return response()->json('Token is Invalid');
         }elseif($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException){
            return response()->json([$exception->getMessage()], $exception->getStatusCode());
        }
        return parent::render($request, $exception);
    }
}
