<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home', [
        'galleryImages' => scanGallery(),
        'atelierImages' => scanGallery('atelier'),
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

// ── Helper: scan gallerij directory ─────────────────────────────────────────
if (!function_exists('scanGallery')) {
function scanGallery(string $folder = 'gallerij'): array {
    $dir     = public_path('assets/client/images/' . $folder);
    $allowed = ['jpg', 'jpeg', 'png', 'webp', 'avif'];
    $images  = [];
    if (is_dir($dir)) {
        $files = array_values(array_filter(scandir($dir), function ($f) use ($dir, $allowed) {
            return is_file($dir . DIRECTORY_SEPARATOR . $f)
                && in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), $allowed, true);
        }));
        natsort($files);
        foreach ($files as $file) {
            $images[] = 'assets/client/images/' . $folder . '/' . $file;
        }
    }
    return $images;
}
} // end if (!function_exists)

Route::get('/ramen', function () {
    $galleryImages = scanGallery('ramen');
    return view('pages.ramen', compact('galleryImages'));
})->name('ramen');

Route::get('/deuren', function () {
    $galleryImages = scanGallery('deuren');
    return view('pages.deuren', compact('galleryImages'));
})->name('deuren');

Route::get('/trappen', function () {
    $galleryImages = scanGallery('trap');
    return view('pages.trappen', compact('galleryImages'));
})->name('trappen');

Route::get('/houtsoorten', function () {
    // Massief hout is the overarching category — passed separately so the blade
    // can present it as a hierarchy intro above the specific wood-type cards.
    $massieHoutBeschrijving = 'In de wereld van houtbewerking onderscheidt elk type hout zich door zijn unieke kenmerken en kwaliteiten. Neem bijvoorbeeld massief hout, dat alom geprezen wordt om zijn lange levensduur in vergelijking met samengestelde houtproducten. Bovendien straalt het een natuurlijke schoonheid uit, waarbij de zichtbare nerfpatronen en kleurschakeringen elk stuk een unieke identiteit geven. Deze schoonheid gaat hand in hand met zijn kracht en weerstand tegen aanzienlijke gewichten en druk. Bovendien is het bijzonder bewerkbaar, waardoor deze houtsoort zich zeer goed leent voor zagen, schuren en schaven.';

    $woodTypes = [
        [
            'name'        => 'Afzelia',
            'description' => 'Afzelia, met zijn opvallende roodbruine kleur en prominente nerf, is niet alleen mooi om naar te kijken, maar staat ook bekend om zijn indrukwekkende duurzaamheid. Een bijzonder kenmerk van Afzelia is de dimensionale stabiliteit, wat betekent dat het hout slechts minimaal krimpt of zwelt bij veranderingen in vochtigheid.',
            'best_for'    => ['Buitendeuren', 'Gevelbekleding', 'Buitenramen', 'Drempels'],
            'tone'        => 'Roodbruin tot goudbruin, edel en diep',
            'tone_color'  => '#8B4513',
            'image'       => 'assets/client/images/azfelia.webp',
        ],
        [
            'name'        => 'Afrormosia',
            'description' => 'Afromosia onderscheidt zich door zijn weerstand tegen houtetende insecten zoals termieten. De aantrekkelijke gouden tot donkerbruine tint, gecombineerd met een fijne textuur, maakt het geliefd onder houtbewerkers. Net als Afzelia blinkt Afromosia uit in dimensionale stabiliteit, wat garant staat voor een langdurige vormvastheid van het product.',
            'best_for'    => ['Buitenramen', 'Buitendeuren', 'Gevelbekleding'],
            'tone'        => 'Goudgeel tot goudbruin, warm en edel',
            'tone_color'  => '#B8860B',
            'image'       => 'assets/client/images/afrormosia.webp',
        ],
        [
            'name'        => 'Beukenhout',
            'description' => 'Beukenhout is herkenbaar aan zijn hardheid en hoge slijtvastheid, waardoor het bijzonder duurzaam is. Deze hardheid doet echter niets af aan de mogelijkheid om het hout te bewerken, mede dankzij de uniforme textuur. Als het goed is afgewerkt, kan beukenhout een prachtig glad oppervlak verkrijgen.',
            'best_for'    => ['Binnendeuren', 'Trappen', 'Maatwerk interieur'],
            'tone'        => 'Lichtblond tot roze-beige, helder en fris',
            'tone_color'  => '#E8C9A0',
            'image'       => 'assets/client/images/beukenhout.webp',
        ],
        [
            'name'        => 'Eerste keus',
            'description' => 'Franse eik, vaak geassocieerd met luxe en traditie, heeft karakteristieke nerfpatronen en een rijke kleur die het een tijdloze uitstraling geven. Afgezien van zijn esthetische aantrekkingskracht, is het ook opvallend duurzaam en biedt het een natuurlijke weerstand tegen insecten en schimmels. Ondanks dat het een hardhout is, is het verrassend bewerkbaar.',
            'best_for'    => ['Ramen', 'Deuren', 'Trappen', 'Maatwerk'],
            'tone'        => 'Eik / Franse eik — warm goudbruin, rijke nerf, tijdloos',
            'tone_color'  => '#A0522D',
            'image'       => 'assets/client/images/franseEik.webp',
        ],
        [
            // TODO: Confirm exact Meranti variant/species used in production before updating this description.
            'name'        => 'Meranti',
            'description' => 'Ook is er Meranti, een veelzijdige en populaire houtsoort. Het is niet alleen geschikt voor diverse toepassingen, van meubels tot deurbekledingen, maar het is ook vaak voordeliger in vergelijking met andere hardhoutsoorten. Deze economische efficiëntie gaat niet ten koste van de kwaliteit, aangezien Meranti prachtig afgewerkt kan worden om zijn natuurlijke schoonheid te accentueren. Afhankelijk van zijn herkomst, biedt het ook een matige tot goede weerstand tegen schimmels en insecten.',
            'best_for'    => ['Ramen', 'Binnendeuren', 'Buitendeuren'],
            'tone'        => 'Roodachtig bruin, licht en warm',
            'tone_color'  => '#C04000',
            'image'       => 'assets/client/images/meranti.webp',
        ],
    ];

    return view('pages.houtsoorten', compact('woodTypes', 'massieHoutBeschrijving'));
});
