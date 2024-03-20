<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            // 'email' => 'required|unique:users,email',
            'mobile_number' => 'required|string|unique:users,phone',
            // 'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            // 'confirm_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $password = $request->input('password');
        $user = User::create([
            'name' => $request->input('name'),
            // 'email' => $request->input('email'),
            // 'password' => bcrypt($password),
            'phone' => $request->input('mobile_number'),
        ]);

        return response()->json(['user' => $user], 201);
    }
}
