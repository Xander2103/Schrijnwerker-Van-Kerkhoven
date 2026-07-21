@extends('layouts.client')

@section('page_title', __('site.rate_limited_title'))
@section('page_description', __('site.rate_limited_message'))

@push('head')
    <meta name="robots" content="noindex, nofollow">
@endpush

@section('content')

@php $locale ??= 'nl'; @endphp

<section class="client-section wood-bg-sand">
    <div class="client-container">
        <div class="section-header" style="text-align:center;">
            <span class="section-eyebrow">{{ __('site.rate_limited_eyebrow') }}</span>
            <h1 class="section-title">{{ __('site.rate_limited_title') }}</h1>
            <p class="section-intro">{{ __('site.rate_limited_message') }}</p>
            <p style="display:flex;flex-wrap:wrap;gap:1rem;justify-content:center;margin-top:2rem;">
                <a href="/{{ $locale }}/contact" class="btn btn-primary">{{ __('site.rate_limited_cta') }}</a>
                <a href="/{{ $locale }}" class="btn btn-secondary">{{ __('site.rate_limited_home') }}</a>
            </p>
        </div>
    </div>
</section>

@endsection
