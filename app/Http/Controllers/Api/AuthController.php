<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response as FacadesResponse;
use PDO;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user =  User::create([
            // 'id' => i,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => $validated['level']
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return $this->apiSuccess([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'level' => $user->level,
                'status' => $user->status,
                'updated_at' => $user->updated_at,
                'created_at' => $user->created_at,
            ]
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) {
            return $this->apiError('Credentials not match', Response::HTTP_UNAUTHORIZED, 'Tolong Masukkan akun yang sesuai');
        }

        if (Auth::user()->status == 0) {
            return $this->apiError('Verification Error', Response::HTTP_UNAUTHORIZED, 'Akun belum diverifikasi');
        }

        $user = User::where('email', $validated['email'])->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->apiSuccess([
            'token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->apiSuccess('Tokens revoked');
        } catch (\Throwable $e) {
            throw new HttpResponseException($this->apiError(null, Response::HTTP_INTERNAL_SERVER_ERROR,));
        }
    }
}
