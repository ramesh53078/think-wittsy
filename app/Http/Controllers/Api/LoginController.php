<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\UserDevice;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{

    private $device;
    public function __construct()
    {
        $this->device = new UserDevice();
    }
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

        // Check the number of devices
        $userDevicesCount = $user->devices()->count();

        if ($userDevicesCount >= 3) {
            return response()->json([
                'status' => 'error',
                'message' => 'You can only log in from up to three devices.',
            ], 403);
        }

        // Create a new device entry
        
        $device_id = $request->input('device_id');
        $exist_device = $this->device->where('device_id', $device_id)->where('user_id', $user->id)->first();

        if($exist_device) {
            $exist_device = $this->device->where('device_id', $device_id)->where('user_id', $user->id)->delete();
        }
        $user->devices()->create(['device_id' => $device_id,'device_name' => $request->input('device_name')]);

        // Generate a new token
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate token.',
            ], 500);
        }

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

        $response = $this->sendOTPUsing2FactorIn($mobileNumber, $otp);

        $responseArray = json_decode($response, true);

        if ($responseArray['Status'] === 'Success') {
            // Return success response indicating OTP has been sent
            return response()->json([
                'success' => true,
                'message' => 'OTP sent successfully.',
                'mobile_number' => $mobileNumber,
                // 'otp' => $otp
            ]);
        } else {
            // Handle error response from the API
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again later.',
            ], 500);
        }
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

    private function sendOTPUsing2FactorIn($mobileNumber, $otp)
    {
        // Make an HTTP request to 2Factor.in API to send OTP
        $apiKey = '98936d9e-61af-11ee-addf-0200cd936042';
        $url = "https://2factor.in/API/V1/$apiKey/SMS/$mobileNumber/$otp/Think Wittsy";


            // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session
        $response = curl_exec($ch);

        // Check for errors
        if(curl_errno($ch)){
            $error_message = curl_error($ch);
            // Handle cURL error
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP: ' . $error_message,
            ], 500);
        }

        // Close cURL session
        curl_close($ch);

        // Return the response
        return $response;
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
