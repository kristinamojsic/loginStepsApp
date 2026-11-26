<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Models\Registration;

Route::get('/', function () {
    $draft = session('registration', []);
    $step = (int) request('step', 1);

    if (request()->boolean('finish')) {
        if (empty($draft['name'])) {
            return redirect('/?step=1')->with('error', 'Molimo unesite ime i prezime!');
        }

        if (empty($draft['email'])) {
            return redirect('/?step=2')->with('error', 'Molimo unesite email!');
        }

        if (empty($draft['accept_terms'])) {
            return redirect('/?step=3')->with('error', 'Molimo prihvatite uslove!');
        }

        Registration::create([
            'name' => $draft['name'],
            'email' => $draft['email'],
            'accept_terms' => $draft['accept_terms'],
        ]);

        session()->forget('registration');

        return redirect()->route('success');
    }

    if ($step >= 2 && empty($draft['name'])) {
        return redirect('/?step=1')->with('error', 'Molimo unesite ime i prezime!');
    }

    if ($step >= 3 && empty($draft['email'])) {
        return redirect('/?step=2')->with('error', 'Molimo unesite email!');
    }

    return view('index', [
        'step' => $step,
        'draft' => $draft,
    ]);
});

Route::get('/success', function () {
    return view('success');
})->name('success');

Route::post('/step1', [RegistrationController::class, 'step1'])->name('step1');
Route::post('/step2', [RegistrationController::class, 'step2'])->name('step2');
Route::post('/step3', [RegistrationController::class, 'step3'])->name('step3');
