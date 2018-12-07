<?php

namespace App\Http\Middleware\Auth;

use App\Services\Auth\TokenService;
use Closure;

class TokenAuth
{
    /**
     * @var TokenService
     */
    private $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->tokenService->validate($request);

        return $next($request);
    }
}
