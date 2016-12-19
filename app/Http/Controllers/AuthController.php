<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 21:21
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        try {
            if (!$token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json('User not found', 200);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json('Token expired', 200);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json('Token invalid', 200);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json($e->getMessage(), 500);
        }

        $userDetails = Auth::user();
        $userDetails->token = $token;
        return response()->json($userDetails);
    }
}