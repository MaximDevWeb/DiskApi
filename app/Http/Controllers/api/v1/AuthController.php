<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Method for registering on the site
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'confirm' => 'required|same:password',
            'accept' => 'accepted',
        ]);

        User::create($request->all());

        return response()->json(['status' => 'success']);
    }

    /**
     * Method for login on the site
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            return response()->json([
                'status' => 'success',
                'token' => $user->createToken('auth')->plainTextToken,
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['email and password don`t match'],
        ]);
    }

    /**
     * Method for obtaining user data after authorization
     *
     * @return JsonResponse
     */
    public function auth_user(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'user' => User::find(Auth::id()),
        ]);
    }

    /**
     * Method for logout on the site
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();

        return response()->json(['status' => 'success']);
    }

    /**
     * Method for password forgot on the site
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function forgot(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        Password::sendResetLink(
            $request->only('email')
        );

        return response()->json(['status' => 'success']);
    }

    /**
     * Method for password change
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function password(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            'confirm' => 'required|same:password',
            'token' => 'required'
        ]);

        Password::reset(
            $request->only('email', 'password', 'token'),
            function ($user, $password) {
                $user->password = $password;
                $user->save();
            }
        );

        return response()->json(['status' => 'success']);
    }
}
