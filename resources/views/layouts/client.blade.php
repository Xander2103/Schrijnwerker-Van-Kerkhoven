<!DOCTYPE html>
<html lang="{{ $locale ?? 'nl' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page_title', __('site.meta_title_home'))</title>
    <meta name="description" content="@yield('page_description', __('site.meta_desc_home'))">

    @if(!empty(config('seo.keywords')))
        <meta name="keywords" content="{{ implode(', ', config('seo.keywords', [])) }}">
    @endif

    @if(config('seo.noindex'))
        <meta name="robots" content="noindex">
    @endif

    {{-- Canonical: locale-aware --}}
    @php
        $canonicalBase = rtrim(config('seo.canonical_url', ''), '/');
        $currentPath   = request()->path();
    @endphp
    @if(!empty($canonicalBase))
        <link rel="canonical" href="{{ $canonicalBase }}/{{ $currentPath }}">
    @endif

    {{-- hreflang alternate links --}}
    @php
        $localeUrls ??= [];
        $hreflangMap = ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en'];
    @endphp
    @foreach($hreflangMap as $loc => $hreflang)
        @if(isset($localeUrls[$loc]))
            <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ url($localeUrls[$loc]) }}">
        @endif
    @endforeach
    @if(isset($localeUrls['nl']))
        <link rel="alternate" hreflang="x-default" href="{{ url($localeUrls['nl']) }}">
    @endif

    <meta property="og:title"       content="{{ __('site.meta_title_home') }}">
    <meta property="og:description" content="{{ __('site.meta_desc_home') }}">
    <meta property="og:image"       content="{{ config('seo.og_image') }}">
    <meta property="og:type"        content="{{ config('seo.og_type', 'website') }}">

    @if(config('images.favicon'))
        <link rel="icon" href="{{ asset(config('images.favicon')) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme colors --}}
    <style>
        :root {
            --color-primary:      {{ config('theme.color_primary') }};
            --color-primary-dark: {{ config('theme.color_primary_dark') }};
            --color-secondary:    {{ config('theme.color_secondary') }};
            --color-accent:       {{ config('theme.color_accent') }};
            --color-text:         {{ config('theme.color_text') }};
            --color-text-light:   {{ config('theme.color_text_light') }};
            --color-bg:           {{ config('theme.color_bg') }};
            --color-bg-alt:       {{ config('theme.color_bg_alt') }};
            --color-border:       {{ config('theme.color_border') }};
        }
    </style>

    {{-- Schema.org LocalBusiness --}}
    <script type="application/ld+json">
    @php
    echo json_encode([
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => config('site.name'),
        'description' => config('seo.description'),
        'telephone'   => config('site.phone'),
        'email'       => config('contact.email'),
        'address'     => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => config('site.address'),
            'addressLocality' => config('site.city_name', config('site.city')),
            'postalCode'      => config('site.postal_code', ''),
            'addressRegion'   => config('site.region', ''),
            'addressCountry'  => 'BE',
        ],
        'url' => url('/'),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    @endphp
    </script>

    @stack('head')
</head>
@php $bodyClass = trim($__env->yieldContent('body_class')); @endphp
<body class="client-page{{ $bodyClass ? ' '.$bodyClass : '' }}{{ config('interaction.custom_cursor.enabled') ? ' custom-cursor-enabled' : '' }}">

    @include('partials.nav')

    <main class="has-fixed-nav">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')

</body>
</html>
