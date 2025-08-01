<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use App\Models\ImageGallery;
use App\Models\ProfileVisit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use Carbon\Carbon;
class UserProfileController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        $profileId = Profile::where('user_id', $user->id)->value('id');
        // connection count
        $connectionCount = ConnectionRequest::where(function ($query) use ($profileId) {
            $query->where('sender_id', $profileId)
                ->orWhere('recipient_id', $profileId);
        })
            ->where('status', 1) // ✅ Correct comparison
            ->count();
        // send reqest count
        $SendrequestCount = ConnectionRequest::where('sender_id', $profileId)
            ->where('status', 0)
            ->count();
        // peding request count
        $pendingRequestCount = ConnectionRequest::where('recipient_id', $profileId)
            ->where('status', 0)
            ->count();


        // visitor count
        $visitorCount = ProfileVisit::where('visited_id', $profileId)->count();



        return Inertia::render(
            'Frontend/Pages/User/Dashboard',
            [
                'connectionCount' => $connectionCount,
                'SendrequestCount' => $SendrequestCount,
                'pendingRequestCount' => $pendingRequestCount,
                'visitorCount' => $visitorCount,
            ]
        );
    }
    public function partnerPreference()
    {
        $user = auth()->user();
        $preference = $user->match;
        return Inertia::render(
            'Frontend/Pages/User/PartnerPreference',
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
            ? asset($profile->image)
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
        $uploadPath = 'frontend-assets/imgs/profiles/';
        $fullPath = public_path($uploadPath);

        // Delete old image if exists
        $profile = $user->profile;
        if ($profile->image) {
            $oldPath = public_path($profile->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }
        $file->move($fullPath, $filename);
        $profile->image = $uploadPath . $filename;
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
            'date_of_birth' => 'nullable|date_format:Y-m-d',
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
        $profile->date_of_birth = $request->date_of_birth;
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
            'desc' => 'nullable|string|max:255',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = Auth::user();
        $profile = $user->profile;
        $profile->desc = $request->desc;
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

    public function userMessages()
    {
        return Inertia::render('Frontend/Pages/User/Messages');
    }
    public function userMessagesView($id)
    {
        return Inertia::render('Frontend/Pages/User/Messages', [
            'chatId' => $id,
        ]);
    }
}