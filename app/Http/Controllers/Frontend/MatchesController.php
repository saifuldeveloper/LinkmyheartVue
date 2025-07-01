<?php

namespace App\Http\Controllers\Frontend;
use App\Models\MatchProfile;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MatchesController extends Controller
{


    public function matches()
    {

        $user = Auth::user();
        $profiles = Profile::where('user_id', '!=', $user->id)
            ->where('status', 1)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($profile) {
                $profile->image_path = $profile->image
                    ? asset('Frontend/UserImages/gallery/' . $profile->image)
                    : asset('images/default-profile.png');
                return $profile;
            });


        return Inertia::render(
            'Frontend/Pages/User/Matches',
            [
                'profiles' => $profiles,
            ]
        );
    }

    public function profileView(Request $request)
    {
        return Inertia::render('Frontend/Pages/User/MatchesProfile');
    }



    public function partnerPreferenceUpdate(Request $request)
    {
        $validated = $request->validate([
            'looking_for' => 'required|in:Bride,Groom',
            'from_age' => 'required|integer|min:18',
            'to_age' => 'required|integer|gte:from_age',
            'marital_status' => 'nullable|in:Single,Divorced,Widowed,Awaiting Divorce',
            'religion' => 'required|string',
            'location' => 'nullable|string',
            'education' => 'nullable|string',
            'height_from' => 'nullable|string',
            'height_to' => 'nullable|string',
        ]);

        $user = Auth::user();
        MatchProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        $profile = Profile::where('user_id', $user->id)->first();
        if ($profile) {
            $profile->i_am = $request->looking_for === 'Bride' ? 'Groom' : 'Bride';
            $profile->save();
        }

        // Proceed with matching only if profile exists
        if ($profile) {
            $matchingProfiles = MatchProfile::with('profile')
                ->where('looking_for', $profile->i_am)
                ->where('religion', $profile->religion)
                ->where('user_id', '!=', $user->id)
                ->when($profile->location, function ($query) use ($profile) {
                    $query->where('location', $profile->location);
                })
                ->when(!is_null($profile->age), function ($query) use ($profile) {
                    $query->where('from_age', '<=', $profile->age)
                        ->where('to_age', '>=', $profile->age);
                })
                ->whereHas('profile', function ($query) use ($profile) {
                    if ($profile->gender) {
                        $query->where('gender', '!=', $profile->gender);
                    }
                })
                ->get();

            // foreach ($matchingProfiles as $match) {
            //     $matchedUser = Profile::where('user_id', $match->user_id)->first();
            //     if ($matchedUser) {
            //         try {
            //             Mail::to($matchedUser->email)->send(new NewMatchFoundMail($matchedUser, $profile));
            //         } catch (\Exception $e) {
            //             \Log::error('Email sending failed: ' . $e->getMessage());
            //         }
            //     }
            // }
        }

        return redirect()->back()->with('success', 'Partner preference saved.');
    }

}
