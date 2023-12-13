<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Feedback;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;
use App\Jobs\SendFeedbackEmail;
class FeedbackController extends Controller
{
    public function Feedback(Request $request)
    {
        $user = JWTAuth::authenticate($request->token);

        $validatedData = Validator::make($request->all(), [
            'email' => 'required|email',
            'testimonial' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['errors' => $validatedData->errors()], 400);
        }

        $feedback = Feedback::create([
            'user_id' => $user->id,
            'email' => $request->input('email'),
            'testimonial' => $request->input('testimonial'),
        ]);

        SendFeedbackEmail::dispatch($feedback, $request->input('email'));

        return response()->json(['message' => 'Feedback submitted successfully']);
    }

    
}
