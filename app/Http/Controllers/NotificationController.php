<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $token = $request->token;
        // Save token to database for the authenticated user
        $user = User::find(Auth::user()->id);
        $user->update(['fcm_token' => $token]);

        return response()->json(['success' => true]);
    }
}
