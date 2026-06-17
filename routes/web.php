<?php

use App\Support\GalleryScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'galleryImages' => GalleryScanner::scan(),
        'atelierImages' => GalleryScanner::scan('atelier'),
    ]);
});

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', function (Request $request) {
    // Honeypot: bots fill hidden fields, humans don't
    if (!empty($request->input('website_url'))) {
        return redirect()->back();
    }

    // Daily rate limit: max 2 successful submissions per IP per day
    $ip      = $request->ip();
    $cacheKey = 'contact:daily:' . sha1($ip . ':' . today()->toDateString());
    $count   = (int) Cache::get($cacheKey, 0);

    if ($count >= 2) {
        return redirect()->route('contact')
            ->withInput()
            ->with('contact_rate_error',
                'U heeft vandaag al het maximale aantal berichten verstuurd. ' .
                'Probeer morgen opnieuw of bel ons direct op ' . config('site.phone') . '.');
    }

    $request->validate([
        'name'         => ['required', 'string', 'max:100'],
        'phone'        => ['required', 'string', 'max:30'],
        'email'        => ['nullable', 'email', 'max:150'],
        'request_type' => ['required', 'string', 'max:100'],
        'message'      => ['required', 'string', 'max:2000'],
        'privacy'      => ['accepted'],
    ], [
        'name.required'         => 'Vul uw naam in.',
        'phone.required'        => 'Vul uw telefoonnummer in.',
        'email.email'           => 'Vul een geldig e-mailadres in.',
        'request_type.required' => 'Kies een type aanvraag.',
        'message.required'      => 'Vul een bericht in.',
        'message.max'           => 'Uw bericht mag maximaal 2000 tekens bevatten.',
        'privacy.accepted'      => 'U moet akkoord gaan met het privacybeleid.',
    ]);

    // Increment daily counter after successful validation
    Cache::put($cacheKey, $count + 1, now()->endOfDay());

    return redirect()->route('contact')->with(
        'contact_success',
        'Bedankt, uw aanvraag werd ontvangen. We nemen zo snel mogelijk contact op.'
    );
})->middleware('throttle:5,1')->name('contact.submit');

Route::get('/ramen', function () {
    $galleryImages = array_values(array_filter(
        GalleryScanner::scan('ramen'),
        fn($p) => !str_contains(basename($p), 'hero')
    ));
    return view('pages.ramen', compact('galleryImages'));
})->name('ramen');

Route::get('/deuren', function () {
    $galleryImages = array_values(array_filter(
        GalleryScanner::scan('deuren'),
        fn($p) => !str_contains(basename($p), 'hero')
    ));
    return view('pages.deuren', compact('galleryImages'));
})->name('deuren');

Route::get('/trappen', function () {
    $galleryImages = GalleryScanner::scan('trap');
    return view('pages.trappen', compact('galleryImages'));
})->name('trappen');

Route::redirect('/houtsoorten', '/werkplaats', 301);
Route::redirect('/werkhuis',   '/werkplaats', 301);

Route::get('/werkplaats', function () {
    return view('pages.werkplaats', [
        'atelierImages' => GalleryScanner::scan('atelier'),
    ]);
})->name('werkplaats');
