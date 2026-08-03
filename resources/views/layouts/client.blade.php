<!DOCTYPE html>
<html lang="{{ $locale ?? 'nl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $currentLocale = $locale ?? 'nl';
        $localeUrls ??= [];
        $ogImage ??= null;
        $heroPreload ??= null;
        $routeName = optional(request()->route())->getName();

        // Resolve once so <title>/meta-description and their OG/Twitter
        // equivalents can never drift apart (previously OG always showed
        // the homepage copy, regardless of the page actually being viewed).
        $pageTitle = trim($__env->yieldContent('page_title', __('site.meta_title_home')));
        $pageDescription = trim($__env->yieldContent('page_description', __('site.meta_desc_home')));

        // Canonical: self-reference via the locale-map the current route
        // published (falls back to the raw request path for routes that
        // don't override it). This also resolves the poorten/schuiframen
// cross-locale-slug duplicates (e.g. /fr/poorten) to their real
// canonical URL (/fr/portails) instead of canonicalizing to themselves.
$appUrl = rtrim((string) config('app.url'), '/');
$canonicalPath = '/' . ltrim($localeUrls[$currentLocale] ?? request()->path(), '/');
$canonicalUrl = $appUrl !== '' ? $appUrl . $canonicalPath : null;

$hreflangMap = ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'];
$ogLocaleMap = ['nl' => 'nl_BE', 'fr' => 'fr_BE', 'en' => 'en_US'];

// Pages that share a single route name (the region pages) publish their own
// image as $ogImage; everything else keeps using the per-route seo config.
$ogImagePath = $ogImage ?? config('seo.page_images.' . $routeName) ?? config('seo.og_image');
        $ogImageUrl = $ogImagePath ? asset($ogImagePath) : null;
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">

    @if (config('seo.noindex'))
        <meta name="robots" content="noindex">
    @endif

    @if ($canonicalUrl)
        <link rel="canonical" href="{{ $canonicalUrl }}">
    @endif

    {{-- hreflang alternate links — dezelfde basis-URL als de canonical, zodat
         de twee nooit uit elkaar kunnen lopen. url() zou het schema van het
         binnenkomende request gebruiken en achter een TLS-terminerende proxy
         http:// kunnen opleveren terwijl de canonical https:// zegt. --}}
    @foreach ($hreflangMap as $loc => $hreflang)
        @if (isset($localeUrls[$loc]))
            <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $appUrl . '/' . ltrim($localeUrls[$loc], '/') }}">
        @endif
    @endforeach
    @if (isset($localeUrls['nl']))
        <link rel="alternate" hreflang="x-default" href="{{ $appUrl . '/' . ltrim($localeUrls['nl'], '/') }}">
    @endif

    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:type" content="{{ config('seo.og_type', 'website') }}">
    <meta property="og:site_name" content="{{ config('site.nav_brand', config('site.name')) }}">
    <meta property="og:locale" content="{{ $ogLocaleMap[$currentLocale] ?? 'nl_BE' }}">
    @foreach ($ogLocaleMap as $loc => $ogLocale)
        @if ($loc !== $currentLocale && isset($localeUrls[$loc]))
            <meta property="og:locale:alternate" content="{{ $ogLocale }}">
        @endif
    @endforeach
    @if ($canonicalUrl)
        <meta property="og:url" content="{{ $canonicalUrl }}">
    @endif
    @if ($ogImageUrl)
        <meta property="og:image" content="{{ $ogImageUrl }}">
    @endif

    <meta name="twitter:card" content="{{ config('seo.twitter_card', 'summary_large_image') }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    @if ($ogImageUrl)
        <meta name="twitter:image" content="{{ $ogImageUrl }}">
    @endif

    {{-- LCP: de hero is een CSS-achtergrond, die de browser pas ontdekt nadat
         de stylesheet geparsed is. Een preload haalt hem meteen op. Pagina's
         zetten $heroPreload; zonder dat gebeurt er niets. --}}
    @if (!empty($heroPreload))
        <link rel="preload" as="image" href="{{ asset($heroPreload) }}" fetchpriority="high">
    @endif

    {{-- De twee gewichten die boven de vouw gebruikt worden. --}}
    <link rel="preload" as="font" type="font/ttf" href="{{ asset('fonts/Inter_24pt-Regular.ttf') }}" crossorigin>
    <link rel="preload" as="font" type="font/ttf" href="{{ asset('fonts/PlayfairDisplay-Bold.ttf') }}" crossorigin>

    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#2C1A0E">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme colors --}}
    <style>
        :root {
            --color-primary: {{ config('theme.color_primary') }};
            --color-primary-dark: {{ config('theme.color_primary_dark') }};
            --color-secondary: {{ config('theme.color_secondary') }};
            --color-accent: {{ config('theme.color_accent') }};
            --color-text: {{ config('theme.color_text') }};
            --color-text-light: {{ config('theme.color_text_light') }};
            --color-bg: {{ config('theme.color_bg') }};
            --color-bg-alt: {{ config('theme.color_bg_alt') }};
            --color-border: {{ config('theme.color_border') }};
        }
    </style>

    {{-- Schema.org LocalBusiness (Carpenter) --}}
    <script type="application/ld+json">
    @php
        $business = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Carpenter',
            // Stable id so per-page graphs (Service nodes) can reference this
            // one business instead of describing a second one.
            '@id'         => url('/') . '#business',
            'name'        => config('site.name'),
            'description' => config('site.intro_short'),
            'email'       => config('contact.email'),
            'image'       => asset(config('images.logo_header')),
            'address'     => [
                '@type'           => 'PostalAddress',
                'streetAddress'   => config('site.address'),
                'addressLocality' => config('site.city_name', config('site.city')),
                'postalCode'      => config('site.postal_code', ''),
                'addressRegion'   => config('site.region', ''),
                'addressCountry'  => 'BE',
            ],
            'url' => url('/'),
        ];

        // Only include facts that are actually configured — never fabricate.
        if (!empty(config('site.phone'))) {
            $business['telephone'] = config('site.phone');
        }

        if (!empty(config('site.instagram_url'))) {
            $business['sameAs'] = [config('site.instagram_url')];
        }

        // Coordinates parsed straight from the business's own published Google
        // Maps embed URL — not a separately maintained/guessed value.
        if (preg_match('/!2d(-?[0-9.]+)!3d(-?[0-9.]+)/', (string) config('site.maps_embed_url'), $m)) {
            $business['geo'] = [
                '@type'     => 'GeoCoordinates',
                'latitude'  => $m[2],
                'longitude' => $m[1],
            ];
        }

        echo json_encode($business, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    @stack('head')
</head>
@php $bodyClass = trim($__env->yieldContent('body_class')); @endphp

<body
    class="client-page{{ $bodyClass ? ' ' . $bodyClass : '' }}{{ config('interaction.custom_cursor.enabled') ? ' custom-cursor-enabled' : '' }}">

    {{-- Eerste tabstop: laat toetsenbord- en schermlezergebruikers de
         navigatie overslaan. Alleen zichtbaar zodra hij focus krijgt. --}}
    <a href="#main" class="skip-link">{{ __('site.skip_to_content') }}</a>

    @include('partials.nav')

    <main id="main" class="has-fixed-nav" tabindex="-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')

</body>

</html>
