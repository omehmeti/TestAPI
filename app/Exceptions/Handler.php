<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if( $e instanceof NotFoundHttpException){
            return response()->json(['message'=>'Bad request.Please verify your request route.','code'=>400],400);
        }
        else if ( $e instanceof InvalidRequestException ){
            return response()->json(['message'=>'Invalid Request','code'=>400],400);

        }else if ( $e instanceof MethodNotAllowedHttpException ){
            return response()->json(['message'=>'This method is not allowed here','code'=>400],400);
        }
        else if ( !($e->getMessage() == '') ){
            return response()->json(['message'=>$e->getMessage(),'code'=>400],400);
        }else{
            return parent::render($request, $e);
        }
        
        
        
        
    }
}
