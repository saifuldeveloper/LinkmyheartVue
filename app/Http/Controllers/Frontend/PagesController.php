<?php

namespace App\Http\Controllers\Frontend;
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

        return Inertia::render('Frontend/Pages/Search');
    }

    public function loginSection()
    {
        return Inertia::render('Frontend/Pages/Login');
    }

    public function loginUser(Request $request)
    {

 
        $credentials = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        if (Auth::attempt(['number' => $credentials['phone'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }
        return back()->withErrors([
            'phone' => 'Phone or password is incorrect.',
        ])->onlyInput('phone');


    }
}
