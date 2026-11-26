<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js')
    <title>Registracija</title>
</head>
<body>
<p style="font-weight: bold;"> Registracija - korak {{ $step }} </p>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if($step >= 1)
    <label for="name">Ime i prezime:</label>
    <input type="text" id="name" name="name" value="{{ $draft['name'] ?? '' }}" @disabled($step > 1)><br>
@endif

@if($step >= 2)
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ $draft['email'] ?? '' }}" @disabled($step > 2)><br>
@endif

@if($step >= 3)
    <label for="accept_terms">Prihvatam uslove:</label>
    <input type="checkbox" id="accept_terms" name="accept_terms" value="1" @checked(!empty($draft['accept_terms']))><br>
@endif

@if($step === 1)
    <button id="step1-button" type="button" data-url="/step1" onclick="step1()">submit</button><br>
@elseif($step === 2)
    <button id="step2-button" type="button" data-url="/step2" onclick="step2()">submit</button><br>
@elseif($step === 3)
    <button id="step3-button" type="button" data-url="/step3" onclick="step3()">submit</button><br>
@endif

<a href="/?step=1"> Korak 1 </a>
<a href="/?step=2"> Korak 2 </a>
<a href="/?step=3"> Korak 3 </a>
<a href="/?finish=1"> Kraj </a>
</body>
</html>
