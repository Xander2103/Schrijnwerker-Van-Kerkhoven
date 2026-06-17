@extends('layouts.client')

@section('body_class', 'page-home')

@section('content')

    @if(config('site.sections.hero', true))
        @include('sections.hero')
    @endif

    @if(config('site.sections.bedrijf', true))
        @include('sections.bedrijf')
    @endif

    @if(config('site.sections.trust', true))
        @include('sections.trust')
    @endif

    @if(config('site.sections.wood_teaser', true))
        @include('sections.wood-teaser')
    @endif

    @if(config('site.sections.historisch', true))
        @include('sections.historisch')
    @endif

    @if(config('site.sections.reviews', true) && config('reviews.enabled', false))
        @include('sections.reviews')
    @endif

    @if(config('site.sections.gallery', false))
        @include('sections.gallery')
    @endif

    @if(config('site.sections.contact_cta', true))
        @include('sections.contact-cta')
    @endif

    @if(config('site.sections.location', true))
        @include('sections.location')
    @endif

@endsection
