<?php 
use Illuminate\Http\Request;

if (!function_exists('isApiRequest')) {
    function isApiRequest(Request $request)
    {
        return $request->is('api/*') || $request->expectsJson();
    }
}