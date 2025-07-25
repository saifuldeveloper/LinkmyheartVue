<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Frontend/Pages/Home', [
        ]);
    }

    public function about(Request $request)
    {
        return Inertia::render('Frontend/Pages/About');
    }

    public function pricing(Request $request)
    {
        return Inertia::render('Frontend/Pages/Pricing');
    }

    public function faq(Request $request)
    {
        return Inertia::render('Frontend/Pages/Faq');
    }
    public function support(Request $request)
    {
        return Inertia::render('Frontend/Pages/Support');
    }

    public function filtering(Request $request)
    {
         $authUser = Auth::user();

         if(isset($authUser)){
            $profiles =Profile::where('user_id', '!=', $authUser->id)
            ->where('status', 1)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($profile) {
                $profile->image_path = $profile->image
                    ? asset( $profile->image)
                    : asset('images/default-profile.png');
                return $profile;
            });
         }

          $profiles =Profile::where('status', 1)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($profile) {
                $profile->image_path = $profile->image
                    ? asset( $profile->image)
                    : asset('images/default-profile.png');
                return $profile;
            });

        return Inertia::render('Frontend/Pages/Search');
    }

    public function loginSection()
    {
        return Inertia::render('Frontend/Pages/Login');
    }

}
