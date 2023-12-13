<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile_number' => 'required|string|unique:users,phone,' . $user->id,
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 400);
        }

        try {
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile_number' => $request->input('mobile_number'),
            ]);

            return response()->json(['status' => 'success', 'message' => 'Updated Profile Successfully'], 201);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
