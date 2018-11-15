<?php
/**
 * Created by PhpStorm.
 * User: rafael.nogueira
 * Date: 27/07/17
 * Time: 07:43
 */

namespace App\Auth;


use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWT;

class JWTProvider extends Authorization
{

    private $jwt;
    /**
     * JWTProvider constructor.
     */
    public function __construct(JWT $jwt)
    {
      
        $this->jwt = $jwt;
    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return 'Bearer';
    }

    /**
     * Authenticate the request and return the authenticated user instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Dingo\Api\Routing\Route $route
     *
     * @return mixed
     */
    public function authenticate(Request $request, Route $route)
    {
        try{
            return \Auth::guard('api')->authenticate();
        }catch(AuthenticationException $exception){
            $this->refreshToken();
            return \Auth::guard('api')->user();
        }
    }

    protected function refreshToken(){
        $token = $this->jwt->parseToken()->refresh();
        $this->jwt->setToken($token);
    }
}