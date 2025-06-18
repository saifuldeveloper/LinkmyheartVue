<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class UserProfileController extends Controller
{
    //


    public function partnerPreference(){
         return Inertia::render('Frontend/Pages/User/PartnerPreference');
    }

    public function edit(){
        return Inertia::render('Frontend/Pages/User/Profile'); 
    }
}
