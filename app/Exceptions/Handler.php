<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler{
/**
 * A list of the exception types that should not be reported.
 *
 * @var array
 */
protected $dontReport = [
    HttpException::class,
    ModelNotFoundException::class,
];

/**
 * Report or log an exception.
 *
 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
 *
 * @param  \Exception  $e
 * @return void
 */
public function report(Exception $e){
    return parent::report($e);
}

/**
 * Render an exception into an HTTP response.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Exception  $e
 * @return \Illuminate\Http\Response
 */
public function render($request, Exception $e){
    $exception = \Symfony\Component\Debug\Exception\FlattenException::create($e);
    $statusCode = $exception->getStatusCode($exception);

/**
 * Data Not Found
 */
    if($e instanceOf ModelNotFoundException){
        return response()->view('errors.notfoundcontent');
    }

/**
 * Custom Error Page
 */
    if (env('APP_DEBUG') == FALSE && $statusCode == 500 && $e instanceOf ValidationException != TRUE) {
        return response()->view('errors.'.env('ERROR_PAGE'), [], 500);
    } else {
        return parent::render($request, $e);
    }
}

/**
 * Render the given HttpException.
 *
 * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
 * @return \Symfony\Component\HttpFoundation\Response
 */
protected function renderHttpException(HttpException $e){
    if (view()->exists('errors.'.$e->getStatusCode())){
        return response()->view('errors.'.$e->getStatusCode(), [], $e->getStatusCode());
    }
    else{
        return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
    }
}

}
