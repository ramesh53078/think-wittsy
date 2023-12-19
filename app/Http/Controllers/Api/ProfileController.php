<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use App\UserDevice;
use Auth;
use Illuminate\Support\Facades\Validator;
class ProfileController extends Controller
{
    private $device;
    public function __construct()
    {
        $this->device = new UserDevice();
    }

    public function logout(Request $request)
{
    try {
        // Invalidate the current token
        $user = JWTAuth::authenticate($request->token);

        JWTAuth::parseToken()->invalidate();

        // Logout the user
        Auth::logout();

        $device_id = $request->input('device_id');

        $user->devices()->where('device_id', $device_id)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Logout successful.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to logout.',
        ], 500);
    }
}
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

    public function userDevices(Request $request)
    {
        try {
            $user = JWTAuth::authenticate($request->token);
            $data = $user->devices()->get();

            return response()->json(['status' => 'success', 'data' => $data], 200);
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function removeUserDevice(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'device_id' => 'required',
            
            
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 400);
        }

        try {
            $user = JWTAuth::authenticate($request->token);
            $device_id = $request->input('device_id');
            $exist_device = $this->device->where('device_id', $device_id)->where('user_id', $user->id)->first();
            if($exist_device) {
                $exist_device = $this->device->where('device_id', $device_id)->where('user_id', $user->id)->delete();
                return response()->json(['status' => 'success','message' => 'device removed successfully'],202);
            }else{

                return response()->json(['status' => 'error','message' => 'device not found'],404);
            }
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
