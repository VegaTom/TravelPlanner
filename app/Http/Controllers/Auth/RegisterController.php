<?php

namespace TravelPlanner\Http\Controllers\Auth;

use DB;
use JWTAuth;
use TravelPlanner\Http\Controllers\Controller;
use TravelPlanner\Http\Requests\User\RegisterRequest;
use TravelPlanner\Models\User;
use TravelPlanner\Transformers\UserTransformer;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * @resource Register
 *
 * Handles registration on Comunidad Digital.
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    /**
     * Handle a register request.
     *
     * @param  \TravelPlanner\Http\Requests\User\RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        // grab credentials from the request
        return DB::transaction(function () use ($request) {
            try {
                $user = User::create($request->only('email', 'name', 'password'))
                    ->setUserRole(false);
                $token = JWTAuth::fromUser($user);

                return $this->response->withItem($user, new UserTransformer, null, compact('token'))->setStatusCode(201);

            } catch (JWTException $e) {
                // something went wrong whilst attempting to encode the token
                return $this->response->errorInternalError('could_not_create_token');
            }
        });
    }
}
