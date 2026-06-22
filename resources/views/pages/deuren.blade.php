@extends('layouts.client')

@section('page_title', __('pages.deuren_title'))
@section('page_description', __('pages.deuren_desc'))

@section('content')

@php $locale ??= 'nl'; @endphp

<section
    class="page-hero page-hero--image"
    style="--page-hero-image: url('{{ asset('assets/client/images/deuren/hero-deuren.webp') }}')"
>
    <div class="client-container">
        <div class="page-hero-content">
            <a href="/{{ $locale }}" class="page-back-link" aria-label="{{ __('site.back_home') }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ __('site.back') }}
            </a>
            <span class="section-eyebrow">{{ __('pages.deuren_eyebrow') }}</span>
            <h1 class="page-hero-title">{{ __('pages.deuren_heading') }}</h1>
            <p class="page-hero-intro">{{ __('pages.deuren_intro') }}</p>
        </div>
    </div>
</section>

@php $galleryTitle = __('pages.deuren_gallery'); @endphp
@include('partials.realisaties-gallery')

@endsection
