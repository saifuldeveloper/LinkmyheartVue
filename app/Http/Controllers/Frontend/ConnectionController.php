<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
class ConnectionController extends Controller
{
    public function sendRequest(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
        ]);


        $userId = Profile::where('user_id', Auth::id())->value('id');
        $recipientId = Profile::where('id', $request->recipient_id)->value('id');

        $exists = ConnectionRequest::where(function ($query) use ($userId, $recipientId) {
            $query->where('sender_id', $userId)
                ->where('recipient_id', $recipientId);
        })->orWhere(function ($query) use ($userId, $recipientId) {
            $query->where('sender_id', $recipientId)
                ->where('recipient_id', $userId);
        })->exists();

        if ($exists) {
            return back()->with('message', 'Already sent a connection request.');
        }
        ConnectionRequest::create([
            'sender_id' => $userId,
            'recipient_id' => $recipientId,
            'status' => 0,
        ]);
        return back()->with('message', 'Connection request sent successfully.');

    }

    // cancel request
    public function cancelRequest(Request $request)
    {

        $request->validate([
            'recipient_id' => 'required|exists:users,id',
        ]);
        $authProfileId = Profile::where('user_id', Auth::id())->value('id');
        $recipientProfileId = Profile::where('id', $request->recipient_id)->value('id');

        if (!$authProfileId || !$recipientProfileId) {
            return back()->with('error', 'Profile not found.');
        }
        $connection = ConnectionRequest::where(function ($query) use ($authProfileId, $recipientProfileId) {
            $query->where('sender_id', $authProfileId)

                ->where('recipient_id', $recipientProfileId);
        })->orWhere(function ($query) use ($authProfileId, $recipientProfileId) {
            $query->where('sender_id', $recipientProfileId)
                ->where('recipient_id', $authProfileId);

        })->where('status', 0)
            ->first();

        if ($connection) {
            $connection->delete();
            return back()->with('message', 'Connection request canceled.');
        }


        return back()->with('message', 'No connection request found to cancel.');
    }
    // accept request
    public function acceptRequest(Request $request)
    {
        $request->validate([
            'sender_id' => 'required|exists:users,id', // sender of the request
        ]);
        // Get profile IDs
        $authProfileId = Profile::where('user_id', Auth::id())->value('id');
        $senderProfileId = Profile::where('id', $request->sender_id)->value('id');

        if (!$authProfileId || !$senderProfileId) {
            return back()->with('error', 'Profile not found.');
        }

        // Find the connection request
        $connection = ConnectionRequest::where('sender_id', $senderProfileId)
            ->where('recipient_id', $authProfileId)
            ->where('status', 0) // pending
            ->first();
        if (!$connection) {
            return back()->with('error', 'No pending request found.');
        }
        $connection->update([
            'status' => 1,
        ]);
        return back()->with('message', 'Connection request accepted.');
    }


    public function disconnectRequest(Request $request)
    {
        $connection = ConnectionRequest::find($request->connectID);
        if ($connection) {
            $connection->delete();
            return back()->with('message', 'Connection request disconnected successfully.');
        }
        return back()->with('error', 'No connection request found to disconnect.');
    }


    public function sendRequestList()
    {
        $userId = Profile::where('user_id', Auth::id())->value('id');
        $profiles = ConnectionRequest::where('sender_id', $userId)
            ->where('status', 0)
            ->with(['recipient.user']) 
            ->get()
            ->map(function ($request) {
                $profile = $request->recipient;
                return [
                    ...$profile->toArray(), 
                    'user' => $profile->user, 
                    'image_path' => $profile->image
                        ? asset(  $profile->image)
                        : asset('images/default-profile.png'),
                ];
            });
        return Inertia::render('Frontend/Pages/User/SendRequestList', [
            'profiles' => $profiles,
        ]);
    }
    public function connectionList()
    
    {

        $userId = Profile::where('user_id', Auth::id())->value('id');
        $profiles = ConnectionRequest::where(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->orWhere('recipient_id', $userId);
        })
            ->where('status', 1) // accepted connections
            ->with(['recipient.user', 'sender.user'])
            ->get()
            ->map(function ($request) {
                $profile = $request->recipient;
                return [
                    ...$profile->toArray(), 
                    'user' => $profile->user, 
                    'image_path' => $profile->image
                        ? asset(  $profile->image)
                        : asset('images/default-profile.png'),
                ];
            });

        return Inertia::render('Frontend/Pages/User/ConnectionList', [
            'profiles' => $profiles,
        ]);

    }
    public function pendingRequestList()
    {

        $userId = Profile::where('user_id', Auth::id())->value('id');
        $profiles = ConnectionRequest::where('recipient_id', $userId)
            ->where('status', 0) // pending requests
            ->with(['sender.user'])
            ->get()
            ->map(function ($request) {
                $profile = $request->sender;
                return [
                    ...$profile->toArray(), 
                    'user' => $profile->user, 
                    'image_path' => $profile->image
                        ? asset(  $profile->image)
                        : asset('images/default-profile.png'),
                ];
            });

        return Inertia::render('Frontend/Pages/User/PendingRequestList', [
            'profiles' => $profiles,
        ]);

    }

}
