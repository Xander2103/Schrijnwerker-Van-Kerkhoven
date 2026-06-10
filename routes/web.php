<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $galleryDir = public_path('assets/client/images/gallerij');
    $galleryImages = [];
    if (is_dir($galleryDir)) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
        $files = array_values(array_filter(scandir($galleryDir), function ($f) use ($galleryDir, $allowed) {
            return is_file($galleryDir . DIRECTORY_SEPARATOR . $f)
                && in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), $allowed, true);
        }));
        natsort($files);
        foreach ($files as $file) {
            $galleryImages[] = 'assets/client/images/gallerij/' . $file;
        }
    }
    return view('pages.home', compact('galleryImages'));
});

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::post('/contact', function (Request $request) {
    // Honeypot: bots fill hidden fields, humans don't
    if (!empty($request->input('website_url'))) {
        return redirect()->back();
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

    return redirect()->back()->with(
        'contact_success',
        'Bedankt, uw aanvraag werd ontvangen. We nemen zo snel mogelijk contact op.'
    );
})->middleware('throttle:5,1')->name('contact.submit');

Route::get('/houtsoorten', function () {
    $woodTypes = [
        [
            'name'        => 'Massief hout',
            'description' => 'De klassieke keuze voor duurzaam schrijnwerk. Massief hout biedt maximale sterkte, eerlijke uitstraling en is gemakkelijk te bewerken en restaureren.',
            'best_for'    => ['Ramen', 'Buitendeuren', 'Trappen', 'Binnendeuren'],
            'tone'        => 'Warm naturel, van blond tot diepbruin',
            'tone_color'  => '#C69B5E',
            'image' => 'assets/client/images/massieifhout.webp',
        ],
        [
            'name'        => 'Afzelia',
            'description' => 'Een tropische houtsoort met uitzonderlijke weerstand tegen vocht, schimmels en insecten. Ideaal voor buitentoepassingen die decennialang meegaan.',
            'best_for'    => ['Buitendeuren', 'Gevelbekleding', 'Buitenramen', 'Drempels'],
            'tone'        => 'Roodbruin tot goudbruin, edel en diep',
            'tone_color'  => '#8B4513',
            'image'       => 'assets/client/images/azfelia.webp',
        ],
        [
            'name'        => 'Afrormosia',
            'description' => 'Wordt ook "Afrikaanse teak" genoemd. Bijzonder stabiel en geschikt voor veeleisende omgevingen. Herkenbaar aan zijn warme gouden tint.',
            'best_for'    => ['Buitenramen', 'Buitendeuren', 'Gevelbekleding'],
            'tone'        => 'Goudgeel tot goudbruin, warm en edel',
            'tone_color'  => '#B8860B',
            'image'       => 'assets/client/images/afrormosia.webp',
        ],
        [
            'name'        => 'Beuk',
            'description' => 'Licht van kleur, fijn van nerf en uitstekend bewerkbaar. Beuk is een inlandse houtsoort bij uitstek geschikt voor binnenwerk waar hardheid en een egale afwerking tellen.',
            'best_for'    => ['Binnendeuren', 'Trappen', 'Maatwerk interieur'],
            'tone'        => 'Lichtblond tot roze-beige, helder en fris',
            'tone_color'  => '#E8C9A0',
            'image'       => 'assets/client/images/beukenhout.webp',
        ],
        [
            'name'        => 'Eik / Franse eik',
            'description' => 'Een eerste keuze en populaire premiumhoutsoort voor authentieke ramen en deuren. Herkenbaar aan zijn karakteristieke nerf, zachte glans en tijdloze uitstraling. Franse eik staat bekend om zijn constante kwaliteit en rijke tekening.',
            'best_for'    => ['Ramen', 'Deuren', 'Trappen', 'Maatwerk'],
            'tone'        => 'Warm goudbruin, rijke nerf, tijdloos',
            'tone_color'  => '#A0522D',
            'image'       => 'assets/client/images/franseEik.webp',
        ],
        [
            // TODO: Confirm exact Meranti variant/species used in production before updating this description.
            'name'        => 'Meranti',
            'description' => 'Een toegankelijke houtsoort met een warme roodachtige tint. Goed bewerkbaar en eenvoudig te behandelen of te lakken. Populaire keuze voor ramen en deuren in middenklasse renovaties.',
            'best_for'    => ['Ramen', 'Binnendeuren', 'Buitendeuren'],
            'tone'        => 'Roodachtig bruin, licht en warm',
            'tone_color'  => '#C04000',
            'image'       => 'assets/client/images/meranti.webp',
        ],
    ];

    return view('pages.houtsoorten', compact('woodTypes'));
});
