<?php

namespace App\Exceptions;

use Exception;
use Request;
use Illuminate\Auth\AuthenticationException;
use Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\AdsCategory;
use App\Models\Post;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    {

        if ($this->isHttpException($exception)) {
          $prev_url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
          $statusCode = $exception->getStatusCode();
          if ($prev_url[0] == 'app-admin') {
            if ($statusCode == '404') {
              if (Auth::guard('admin')->check()) {
                return response(view('admin.exception.notfound'), 404);
              }else {
                return redirect()->guest(route('admin.login'));
              }
            }elseif ($statusCode == '403') {
              if (Auth::guard('admin')->check()) {
                return response(view('admin.exception.accessdiened'), 403);
              }else {
                return redirect()->guest(route('admin.login'));
              }
            }
          }else {
            $categories = Category::where('status', 'enabled')->get();
            $ads_categories = AdsCategory::where('status', 'enabled')->get();
            $pupular_posts = Post::orderBy('views', 'DESC')->limit(3)->get();
            if ($statusCode == '404') {
              return response(view('front.exception.notfound', [
                'share_categories' =>  $categories,
                'share_ads_categories' =>  $ads_categories,
                'share_pupular_posts' =>  $pupular_posts,
              ]), 404);
            }elseif ($statusCode == '403') {
              return response(view('front.exception.accessdiened',[
                'share_categories' =>  $categories,
                'share_ads_categories' =>  $ads_categories,
                'share_pupular_posts' =>  $pupular_posts,
              ]), 403);
            }
          }
        }

        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
        $whoops->register();
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
      if ($request->expectsJson()) {
        return response()->json(['message' => $exception->getMessage()], 401);
      }

      $guard = array_get($exception->guards(), 0);
      switch ($guard) {
        case 'admin':
          $login = 'admin.login';
          break;
        default:
        $login = 'login';
          break;
      }
      return redirect()->guest(route($login));
    }
}
