<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimezoneController extends Controller
{
    public function set(Request $request)
    {
        $request->session()->put('timezone', $request->input('timezone'));
        $request->session()->save();

        return response()->json([
            'ok' => true,
            ], 200
        );
    }
}
