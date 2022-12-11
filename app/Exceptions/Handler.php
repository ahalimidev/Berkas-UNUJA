<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;
use Illuminate\Auth\AuthenticationException;
class Handler extends ExceptionHandler
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return redirect()->guest(route('dashboard.index'));
        }
        if ($request->is('web') || $request->is('/*')) {
            return redirect()->guest(route('dashboard.index'));
        }
        return redirect()->guest(route('dashboard.index'));
    }
    public function register()
    {
        $this->renderable(function (Exception $e, $request) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('auth.index');
            }
            if ($e instanceof \Symfony\Component\Routing\Exception\RouteNotFoundException) {
                return response()->view('errors.404');
            }

            if ($e instanceof \Symfony\Component\CssSelector\Exception\InternalErrorException) {
                return response()->view('errors.500');
            }
        });
    }
}
