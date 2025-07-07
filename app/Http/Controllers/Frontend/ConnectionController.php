<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ConnectionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ConnectionController extends Controller
{

    public function sendRequest(Request $request)
    {
        $exists = ConnectionRequest::where(function ($query) use ($request) {
            $query->where('sender_id', Auth::id())
                ->where('recipient_id', $request->recipient_id);
        })
            ->orWhere(function ($query) use ($request) {
                $query->where('sender_id', $request->recipient_id)
                    ->where('recipient_id', Auth::id());
            })
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Request already sent'], 409);
        }

        ConnectionRequest::create([
            'sender_id' => Auth::id(),
            'recipient_id' => $request->recipient_id,
            'status' => 1,
        ]);

        return response()->json(['message' => 'Request sent successfully']);
    }
}
