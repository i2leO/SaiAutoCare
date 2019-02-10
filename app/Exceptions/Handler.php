<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Mail;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler as SymfonyExceptionHandler;
use App\Mail\ExceptionOccured;
use App\Jobs\ExceptionalHanderMail;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if ($this->shouldReport($exception)) {
       // $this->sendEmail($exception); // sends an email
        }
        parent::report($exception);
    }
    // public function sendEmail(Exception $exception)
    // {
    //     // sending email
    // }
    public function sendEmail(Exception $exception)
    {
        try {
            $e = FlattenException::create($exception);

            $handler = new SymfonyExceptionHandler();

            $html = $handler->getHtml($e);
           // dd($html);
 // Mail::to('ashutoshphoenixsoft@gmail.com')->send(new ExceptionOccured($html));
  dispatch(new ExceptionalHanderMail('ashutoshphoenixsoft@gmail.com',$html))->delay(now()->addSeconds(5));
            ExceptionalHanderMail::dispatch('ashutoshphoenixsoft@gmail.com',$html)
                            ->delay(now()->addSeconds(5));

          
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $exception)
    {
        // if ($this->shouldReport($exception)) {
       // $this->sendEmail($exception); // sends an email
      //y  }

       // return response("There Are Some Problem.Please Contact to Your Software Maintenance Team .", 401);
      return parent::render($request, $exception);
    }
}
