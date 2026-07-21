<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@php $hreflangMap = ['nl' => 'nl-BE', 'fr' => 'fr-BE', 'en' => 'en']; @endphp
@foreach($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
@foreach($url['alternates'] as $loc => $href)
        <xhtml:link rel="alternate" hreflang="{{ $hreflangMap[$loc] }}" href="{{ $href }}" />
@endforeach
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $url['alternates']['nl'] }}" />
    </url>
@endforeach
</urlset>
