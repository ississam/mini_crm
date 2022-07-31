<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Employee;

class EnsureUserAuthAndAvaibility
{
    const _RESPONSE_ACCESS_DENIED_CODE = 403;
    const _RESPONSE_ACCESS_DENIED_MESSAGE = 'Acces not allowed';

    const _RESPONSE_USER_NOT_FOUND_CODE = 404;
    const _RESPONSE_USER_NOT_FOUND_MESSAGE = 'password not match';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!$this->checkAuthIdAndPassword()) {
            return response()->json([
                'response_code' => self::_RESPONSE_ACCESS_DENIED_CODE,
                'response_message' => self::_RESPONSE_ACCESS_DENIED_MESSAGE,
            ], 403);
        }

        if (!$this->compareAuthPassword()) {
            return response()->json([
                'response_code' => self::_RESPONSE_USER_NOT_FOUND_CODE,
                'response_message' => self::_RESPONSE_USER_NOT_FOUND_MESSAGE,
            ], 500);
        }

        return $next($request);
    }

    /**
     * Check if auth is ok
     * @return bool
     */
    private function checkAuthIdAndPassword()
    {
        if (isset($_SERVER['PHP_AUTH_USER'])) {

            $this->user_exist = Employee::where('email', $_SERVER['PHP_AUTH_USER'])
                ->where('password', $_SERVER['PHP_AUTH_PW']);
            if ($this->user_exist === null) {

                return false;
            }
            return true;
        }
    }

    /**
     * Check if auth is ok
     * @return bool
     */
    private function compareAuthPassword()
    {

            $this->user_detail = Employee::where('email', $_SERVER['PHP_AUTH_USER'])->first();

            if ($_SERVER['PHP_AUTH_PW'] === ($this->user_detail)->password) {

                return true;
            }
            return false;

        }
}
