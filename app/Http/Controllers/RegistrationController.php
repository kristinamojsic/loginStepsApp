<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function step1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->session()->put('registration.name', $request->name);

        return response()->json([
            'next' => url('/?step=2'),
        ]);
    }

    public function step2(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $request->session()->put('registration.email', $request->email);

        return response()->json([
            'next' => url('/?step=3'),
        ]);
    }

    public function step3(Request $request)
    {
        $request->validate([
            'accept_terms' => 'accepted',
        ]);

        $request->session()->put('registration.accept_terms', true);

        return response()->json([
            'next' => url('/?step=3'),
            'can_finish' => true,
        ]);
    }
}
