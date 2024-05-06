<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    //
    public function requestOTP(Request $request)
    {
        $otp = sprintf('%06d',mt_rand(1,999999));

        $user = User::where('email', $request->email)->update(['otp' => $otp]);

        if ($user) {

            $mail = [
                'title' => 'Email Verification',
                'subject' => 'Joportal email verification OTP',
                'body' => 'Your OTP is: ' . $otp,
            ];

            Mail::to($request->email)->send(new SendMail($mail));

            return response()->json([
                'status' => 200,
                'statusText' => 'success',
                'message' => 'We send otp to ' . $request->email,
            ], 200);
        } else {
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'message' => "Invalid email address",
            ]);
        }
    }

    public function verifyOTP(Request $request)
    {

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)->first();

        if ($user) {
            $user->otp = null;
            $user->email_verified_at = Carbon::now();

            if ($user->update()) {
                return response()->json([
                    'status' => 200,
                    'statuText' => 'success',
                    'message' => 'Successfully Verified',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 400,
                'statusText' => 'fail',
                'message' => 'Your OTP is wrong',
            ], 400);
        }
    }
}
