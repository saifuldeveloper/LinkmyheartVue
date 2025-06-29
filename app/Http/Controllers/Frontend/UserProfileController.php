<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\UserImage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class UserProfileController extends Controller
{
    //


    public function partnerPreference()
    {
        $user = auth()->user();
        $preference = $user->match;
        return Inertia::render(
            'Frontend/Pages/User/PartnerPreference'
            ,
            [
                'preference' => $preference,
                'user' => $user,
            ]
        );
    }

    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;
        return Inertia::render('Frontend/Pages/User/Profile',
            [
                'profile' => $profile,
                'user' => $user,
            ]
            );
    }

    public function verifyAccount()
    {
        return Inertia::render('Frontend/Pages/User/Verification');
    }

    public function ProfileContact()
    {
        return Inertia::render('Frontend/Pages/User/ProfileContact');
    }






    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);
        $user = auth()->user();
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $oldImage = UserImage::where('user_id', $user->id)->first();
        if ($oldImage) {
            $oldFilePath = public_path('user_images/' . $oldImage->image);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
            $oldImage->delete();
        }
        $file->move(public_path('user_images'), $filename);
        UserImage::create([
            'user_id' => $user->id,
            'image' => $filename,
        ]);
        return back()->with('success', 'Profile image updated.');
    }

    public function profileUpdateOne(Request $request)
    {
        $data = $request->all();
        $rules = [
            'name' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:150',
            'year' => 'nullable',
            'day' => 'nullable',
            'month' => 'nullable',
            'location' => 'nullable',
            'religion' => 'nullable',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $profile = $user->profile;
        $profile->name = $request->name;
        $profile->religion = $request->religion;
        $profile->date_of_birth = Carbon::create($request->year, $request->month, $request->day);
        $age = now()->year - $request->year;
        $profile->location = $request->location;
        $profile->bio = $request->bio;
        $profile->age = $age;
        $profile->save();
        $user->name = $profile->name;
        $user->save();
        return back()->with('success', 'Profile image updated.');
    }


    // Update Description
    public function UpdateDscription(Request $request)
    {
        $data = $request->all();

        $rules = [
            'description' => 'nullable|string|max:255',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $profile = $user->profile;
        $profile->desc = $request->description;
        $profile->save();
        return back()->with('success', 'Profile updated.');
    }

    public function updatePersonalInfo(Request $request)
    {
        $data = $request->all();

        $rules = [
            'height' => 'required',
            'weight' => 'required',
            'bloodGroup' => 'nullable |string|max:10',
            'bodyType' => 'nullable|string|max:50',
            'education_level' => 'nullable|string|max:100',
            'complexion' => 'nullable|string|max:100',
            'educationInstitute' => 'nullable|string',
            'education_year' => 'nullable|string',
            'profession' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
            'monthlyIncome' => 'nullable',
            'accountFor' => 'nullable|string|max:100',
            'gender' => 'required|string|in:Male,Female,Other',
            'marritalStatus' => 'nullable|string|max:50',
            'natinality' => 'nullable|string|max:50',
            'birthPlace' => 'nullable|string|max:100',
            'familyStatus' => 'nullable|string|max:50',
            'livingWithfamily' => 'nullable|string|max:50',
            'smoking' => 'nullable|string|max:50',
            'drinking' => 'nullable|string|max:50',

        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();

        }
        $user = Auth::user();
        $profile = $user->profile;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->blood_group = $request->bloodGroup;
        $profile->body_type = $request->bodyType;
        $profile->education_level = $request->education_level;
        $profile->complexion = $request->complexion;
        $profile->institute_name = $request->educationInstitute;
        $profile->education_year = $request->education_year;
        $profile->profession = $request->profession;
        $profile->designation = $request->position;
        $profile->monthly_income = $request->monthlyIncome;
        $profile->account_for = $request->accountFor;
        $profile->gender = $request->gender;
        $profile->marital_status = $request->marritalStatus;
        $profile->natinality = $request->natinality;
        $profile->birth_place = $request->birthPlace;
        $profile->family_status = $request->familyStatus;
        $profile->living_with_family = $request->livingWithfamily;
        $profile->smoking = $request->smoking;
        $profile->drinking = $request->drinking;
        $profile->save();
        return back()->with('success', 'Profile updated.');

    }

}
