<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use App\User;


class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $user_repository;

    public function __construct( UserRepository $user_repository )
    {
      $this->user_repository = $user_repository;
    }

    public function accessToken(Request $request){

           

        $this->validateLogin($request);
  
        $credentials = $this->credentials($request);


        if ($token = \Auth::guard('api')->attempt($credentials)) {
            return $this->sendLoginResponse($request, $token);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        // JWTAuth::setToken($token);
        // $user = JWTAuth::authenticate();
        // $user->ultimo_acesso = Carbon::now();
        // $user->save();

        //$token = JWTAuth::fromUser($user);

        return ['token' => $token];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ],400);
    }

    public function logout(Request $request, $user_id)
    {
        $user = User::find($user_id);
        $user->ultimo_acesso = Carbon::now();
        $user->save();

        \Auth::guard('api')->logout();
        return response()->json([], 204);
    }

    public function refreshToken(Request $request)
    {

        $token = \Auth::guard('api')->refresh();
        return $this->sendLoginResponse($request, $token);
    }

    public function teste()
    {
        return 'url segura';
    }
}
