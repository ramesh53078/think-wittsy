<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $loginIdentifier = $request->input('email_or_phone');
        $password = $request->input('password');
        $field = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        $user = User::where($field, $loginIdentifier)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.',
            ], 401);
        }
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'token' => $token,
            'data' => $user,
        ]);
    }

    public function otpLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required', 'regex:/^[0-9]{10}$/', 'exists:users,phone'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobileNumber = $request->input('mobile_number');

        // Generate and store an OTP (you need to implement this part)
        $otp = $this->generateAndStoreOTP($mobileNumber);

        // Send OTP to the user (you need to implement this part)

        // Return success response indicating OTP has been sent
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully.',
            'mobile_number' => $mobileNumber,
            'otp' => $otp
        ]);
    }
    

    // Assume this function generates and stores an OTP for the given mobile number
    private function generateAndStoreOTP($mobileNumber)
    {
        // You need to implement the logic to generate and store an OTP
        // For example, you might generate a random 6-digit OTP and store it in the database
        // Make sure to associate the OTP with the user's mobile number
        // Return the generated OTP
        $otp = mt_rand(100000, 999999);
        User::where('phone', $mobileNumber)->update(['otp' => Hash::make($otp)]);
        return $otp;
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => ['required', 'regex:/^[0-9]{10}$/'],
            'otp' => ['required', 'digits:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $mobileNumber = $request->input('mobile_number');
        $otp = $request->input('otp');

        // Verify the OTP (you need to implement this part)
        if ($this->verifyOTPFromStorage($mobileNumber, $otp)) {
            // If OTP is valid, generate a token and return success response
            $user = User::where('phone', $mobileNumber)->first();

            // Generate a token for the user
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success' => true,
                'token' => $token,
                'data' => $user,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 400);
        }
    }

    private function verifyOTPFromStorage($mobileNumber, $enteredOTP)
    {
            // You need to implement the logic to retrieve the hashed OTP from the database
            // For example, you might retrieve it from the 'otp' column in the users table
            $hashedStoredOTP = $this->getStoredOTP($mobileNumber);

            // Compare $enteredOTP with the hashed stored OTP
            return Hash::check($enteredOTP, $hashedStoredOTP);
    }

    private function getStoredOTP($mobileNumber)
    {
        // You need to implement the logic to retrieve the hashed OTP from the database
        // For example, you might retrieve it from the 'otp' column in the users table
        $user = User::where('phone', $mobileNumber)->first();

        return $user ? $user->otp : null;
    }
}