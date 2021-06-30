<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebPushController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() 
    {
        return view('web_push.create');
    }

    public function store(Request $request) {

        $this->validate($request, [
            'endpoint'    => 'required',
            'keys.auth'   => 'required',
            'keys.p256dh' => 'required'
        ]);

        $endpoint = $request->endpoint;
        $token = $request->keys['auth'];
        $key = $request->keys['p256dh'];
        $user = $request->user();
        $user->updatePushSubscription($endpoint, $key, $token);

        return response()->json([
            'success' => true
        ], 200);

    }
}
