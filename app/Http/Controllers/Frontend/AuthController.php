<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Profile;
use App\Models\UserOtpVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Exception;
class AuthController extends Controller
{
    public function registerOtp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,15',
            'gender' => 'required|in:male,female,other',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        if (User::where('number', $request->phone)->exists()) {
            return response()->json(['error' => 'Phone number already registered. Please log in.'], 409);
        }
        $otp = rand(100000, 999999);
        $tempData = UserOtpVerification::updateOrInsert(
            [
                'number' => $request->phone,
            ],
            [
                'name' => $request->name,
                'otp_code' => $otp,
                'gender' => $request->gender,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(10),

            ]
        );
        try {
            $message = "{$otp} is  your Linkmyheart verification code";
            // Http::post(env('SMS_PROVIDER_URL'), [
            //     'api_key' => env('SMS_API_KEY'),
            //     'msg' => $message,
            //     'to' => $request->phone,
            //     'sender_id' => env('SMS_SENDER_ID'),
            // ]);
            return response()->json(['success' => true, 'code' => $otp, 'message' => 'OTP has been sent to your phone.']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while sending the OTP. Please try again later.', 'error' => $e->getMessage()]);
        }

    }


    public function registerOtpVerify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits_between:10,15',
            'otp' => 'required|digits:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $userData = UserOtpVerification::where('number', $request->phone)->where('otp_code', $request->otp)
            ->where('expires_at', '>', now())
            ->first();
        if (!$userData) {
            return response()->json(['error' => false, 'message' => 'Time out.'], 200);
        }
        $userData->status = 1;
        $userData->save();
        return response()->json(['success' => true, 'message' => 'OTP verified successfully.'], 200);

    }

    public function registration(Request $request)
    {


        $userData = UserOtpVerification::where('number', $request->phone)->first();

        if (!$userData) {
            return response()->json(['error' => false, 'message' => 'Not verified.'], 400);
        }
        $password = Hash::make($request->confirm_password);
        $user = new User();
        $user->name = $request->name;
        $user->number = $request->phone;
        $user->password = $password;
        $user->unique_id = 'LMH' . $user->getNextId();
        $user->save();
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->gender = $request->gender;
        $profile->save();
        Auth::login($user);
        $userData->delete();
        return response()->json([
            'success' => true,
            'redirect' => route('dashboard')
        ]);

    }
}
