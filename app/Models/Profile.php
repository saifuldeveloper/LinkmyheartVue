<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Profile extends Model
{

    protected $primaryKey = 'user_id';   // ✅ tell Eloquent to use user_id as primary key
    public $incrementing = false;        // ✅ because user_id is not auto-incrementing
    protected $keyType = 'int';
    protected $fillable = [
        'name',
        'date_of_birth',
        'location',
        'bio',
        'religion',
        'i_am',
        'account_for',
        'show_images',
        'desc',
        'age',
        'gender',
        'nationality',
        'present_address',
        'marital_status',
        'blood_group',
        'smoking',
        'drinking',
        'height',
        'weight',
        'education_level',
        'profession',
        'institute_name',
        'education_year',
        'designation',
        'monthly_income',
        'body_type',
        'complexion',
        'family_status',
        'living_with_family',
        'status',
        'additional_document',
        'image',
        'show_contact'
    ];

    public static function saveInfo($request)
    {

        $user = Auth::user();
        $profile = $user->profile;

        if (is_null($profile)) {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $profile->user_id = Auth::user()->id;
        $profile->gender = $request->gender;
        $profile->name = Auth::user()->name;

        if ($request->nationality == 'Bangladesh') {
            $profile->birth_place = $request->birth_place;
        } else {
            $profile->birth_place = $request->birth_place_text;
        }
        $profile->nationality = $request->nationality;
        $profile->education_level = $request->education;
        $profile->marital_status = $request->marital_status;
        $profile->blood_group = $request->blood_group;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->profession = $request->profession;
        $profile->living_with_family = $request->living_with_family;
        $profile->body_type = $request->body_type;
        $profile->complexion = $request->complexion;
        $profile->family_status = $request->family_status;
        $profile->monthly_income = $request->monthly_income;
        $profile->institute_name = $request->education_institute;
        $profile->education_year = $request->education_year;
        $profile->designation = $request->position;
        $profile->account_for = $request->account_for;
        $profile->living_with_family = $request->living_with_family;
        $profile->smoking = $request->smoking;
        $profile->drinking = $request->drinking;
        $profile->save();

    }

    public static function saveImage($request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Check if the file is valid
            if (!$image->isValid()) {
                throw new \Exception("The file upload failed: " . $image->getErrorMessage());
            }

            $imageNewName = $request->first_name . rand() . '.' . $image->extension();

            // Define directories
            $dir1 = "frontend-assets/imgs/profiles/";
            $dir2 = "storage/users-avatar/";

            // Ensure the directories exist
            if (!file_exists(public_path($dir1))) {
                mkdir(public_path($dir1), 0777, true);
            }

            if (!file_exists(public_path($dir2))) {
                mkdir(public_path($dir2), 0777, true);
            }

            // Move image to the first directory
            $image->move(public_path($dir1), $imageNewName);

            // Copy image to the second directory
            $sourcePath = public_path($dir1 . $imageNewName);
            $destinationPath = public_path($dir2 . $imageNewName);

            // Ensure the source file exists before copying
            if (!file_exists($sourcePath)) {
                throw new \Exception("The source image does not exist.");
            }

            // Copy the file
            if (!copy($sourcePath, $destinationPath)) {
                throw new \Exception("Failed to copy the image to the second directory.");
            }

            // Return the URL of the image in the first directory
            return $dir1 . $imageNewName;
        }
        throw new \Exception("No file was uploaded.");
    }


    public function calculateCompletionPercentage()
    {
        // Define the fields to check for profile completion
        $fields = [
            'i_am',
            'account_for',
            'image',
            'bio',
            'desc',
            'name',
            'gender',
            'religion',
            'date_of_birth',
            'age',
            'location',
            'birth_place',
            'nationality',
            //  'present_address', 
            'email',
            'contact_number',
            'marital_status',
            'blood_group',
            'smoking',
            'drinking',
            'height',
            'weight',
            'education_level',
            'profession',
            'institute_name',
            'education_year',
            'designation',
            'monthly_income',
            // 'living_with_family',
            'body_type',
            'complexion',
            'family_status'
        ];

        // Count how many of the required fields are filled
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }

        // Calculate the completion percentage
        $completionPercentage = ($filledFields / count($fields)) * 100;

        return (int) $completionPercentage;// return the rounded percentage
    }


    public function getCompletionPercentageAttribute()
    {
        return $this->calculateCompletionPercentage();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matchProfile()
    {
        return $this->hasOne(MatchProfile::class, 'user_id', 'user_id');
    }
}
