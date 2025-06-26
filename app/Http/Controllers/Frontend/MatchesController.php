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
        return Inertia::render('Frontend/Pages/User/Matches');
    }

    public function profileView(Request $request)
    {
        return Inertia::render('Frontend/Pages/User/MatchesProfile');
    }



    public function partnerPreferenceUpdate(Request $request)
    {
        // ✅ Inertia-compatible validation
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

        // ✅ Create or update match profile
        $match = $user->match ?? new MatchProfile(['user_id' => $user->id]);
        $match->fill($validated)->save();



        $profile = Auth::user()->profile;

        if ($request->looking_for == 'Bride') {
            $profile->i_am = 'Groom';
        } else {
            $profile->i_am = 'Bride';
        }

        $profile->save();

        $matchProfileData = MatchProfile::where('user_id', Auth::user()->id)->first();



        $age = Auth::user()->profile->age;



        $matchingProfiles = MatchProfile::with('profile')
            ->where('looking_for', Auth::user()->profile->i_am)
            ->orwhere('religion', Auth::user()->profile->religion)
            ->whereHas('profile', function ($query) {
                $query->where('gender', '!=', Auth::user()->profile->gender);
            });

        if ($matchingProfiles) {
            $matchingProfiles->where('location', $matchingProfiles->location)
                ->where('user_id', '!=', Auth::user()->id)
                ->where('from_age', '<=', $matchingProfiles->from_age)
                ->where('to_age', '>=', $matchingProfiles->to_age);
        }
        $new_user = Profile::where('user_id', Auth::id())->first();
        $matchingProfiles = $matchingProfiles->get();


        foreach ($matchingProfiles as $match) {
            $matchedUser = Profile::where('user_id', $match->user_id)->first();
            if ($matchedUser) {
                try {
                    Mail::to($matchedUser->email)->send(new NewMatchFoundMail($matchedUser, $new_user));
                } catch (\Exception $e) {
                    \Log::error('Email sending failed: ' . $e->getMessage());
                }
            }
        }


        // ✅ Redirect (Inertia expects this)
        return redirect()->back()->with('success', 'Partner preference saved.');
    }

}
