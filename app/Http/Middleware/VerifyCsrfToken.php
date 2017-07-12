<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

	// public function render($request, Exception $e)
 //    {

 //        if ($e instanceof \Illuminate\Session\TokenMismatchException)
 //        {
 //            $msg = 'Validation Token was expired. Please try again';
 //            return redirect()->route('login')->with('STATUS_WARNING', $msg);
 //        }   

 //        return parent::render($request, $e);
 //    }
}
