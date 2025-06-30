<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
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

        $profileImage = $profile->image
            ? asset('Frontend/UserImages/profile/' . $profile->image)
            : asset('user_images/default.png');
        $galleryImages = ImageGallery::where('user_id', $user->id)
            ->get()
            ->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => asset('Frontend/UserImages/gallery/' . $image->image),
                ];
            });
        return Inertia::render(
            'Frontend/Pages/User/Profile',
            [
                'profile' => $profile,
                'profileImage' => $profileImage,
                'galleryImages' => $galleryImages,
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
            'image' => 'required|image|max:2048',
        ]);
        $user = auth()->user();
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $profile = $user->profile;
        if ($profile->image) {
            $oldFilePath = public_path('Frontend/UserImages/profile/' . $profile->image);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }
        }
        $file->move(public_path('Frontend/UserImages/profile/'), $filename);
        $profile->image = $filename;
        $profile->save();

        return back()->with('success', 'Profile image updated.');
    }

    public function uploadGalleryImages(Request $request)
    {

        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image',
        ]);

        $user = auth()->user();
        $uploadedImages = [];

        foreach ($request->file('images', []) as $file) {
            $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('Frontend/UserImages/gallery/'), $filename);

            $image = ImageGallery::create([
                'user_id' => $user->id,
                'image' => $filename,
            ]);

            $uploadedImages[] = [
                'id' => $image->id,
                'url' => asset('Frontend/UserImages/gallery/' . $filename),
                'isNew' => false,
            ];
        }

        return response()->json([
            'success' => true,
            'uploadedImages' => $uploadedImages,
        ]);
    }

    public function removeGalleryImages(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:image_galleries,id',
        ]);

        $image = ImageGallery::findOrFail($request->id);
        $filePath = public_path('Frontend/UserImages/gallery/' . $image->image);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
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
            'city' => 'nullable',
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
        $profile->location = $request->city;
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