<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{


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
