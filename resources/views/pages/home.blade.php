@extends('layouts.client')

@section('content')

    @if(config('site.sections.hero', true))
        @include('sections.hero')
    @endif

    @if(config('site.sections.welcome', true))
        @include('sections.welcome')
    @endif

    @if(config('site.sections.specialisaties', true))
        @include('sections.specialisaties')
    @endif

    @if(config('site.sections.about', true))
        @include('sections.about')
    @endif

    @if(config('site.sections.trust', true))
        @include('sections.trust')
    @endif

    @if(config('site.sections.reviews', true) && config('reviews.enabled', false))
        @include('sections.reviews')
    @endif

    @if(config('site.sections.gallery', true))
        @include('sections.gallery')
    @endif

    @if(config('site.sections.wood_teaser', true))
        @include('sections.wood-teaser')
    @endif

    @if(config('site.sections.contact', true))
        @include('sections.contact')
    @endif

    @if(config('site.sections.location', true))
        @include('sections.location')
    @endif

@endsection
