<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendudukController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'nik' => 'required',
                'password' => 'required'
            ]);

            $user = Penduduk::where('nik', $request->nik)->first();
            if (!$user || !Hash::check($request->password, $user->password, [])) {
                return ResponseFormatter::error([
                    'message' => 'Invalid Credentials'
                ], 'Authentication Failed', 500);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Login Successful');

        } catch (Exception $exception) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $exception
            ], 'Authentication Failed', 500);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success([
            'is_revoked' => $token
        ], 'Token Revoked');
    }
}
