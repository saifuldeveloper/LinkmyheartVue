<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class MatchesController extends Controller
{
    

    public function matches(){
           return Inertia::render('Frontend/Pages/User/Matches'); 
    }

    public function profileView(Request $request){
         return Inertia::render('Frontend/Pages/User/MatchesProfile'); 
    }
}
