<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page_title', config('seo.title'))</title>
    <meta name="description" content="@yield('page_description', config('seo.description'))">

    @if(!empty(config('seo.keywords')))
        <meta name="keywords" content="{{ implode(', ', config('seo.keywords', [])) }}">
    @endif

    @if(config('seo.noindex'))
        <meta name="robots" content="noindex">
    @endif

    @if(!empty(config('seo.canonical_url')))
        <link rel="canonical" href="{{ config('seo.canonical_url') }}">
    @endif

    <meta property="og:title"       content="{{ config('seo.og_title') }}">
    <meta property="og:description" content="{{ config('seo.og_description') }}">
    <meta property="og:image"       content="{{ config('seo.og_image') }}">
    <meta property="og:type"        content="{{ config('seo.og_type', 'website') }}">

    @if(config('images.favicon'))
        <link rel="icon" href="{{ asset(config('images.favicon')) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme colors injected as CSS custom properties --}}
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

    {{-- Schema.org LocalBusiness structured data --}}
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
