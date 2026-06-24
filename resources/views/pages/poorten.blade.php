@extends('layouts.client')

@section('page_title', __('pages.poorten_title'))
@section('page_description', __('pages.poorten_desc'))

@section('content')

@php $locale ??= 'nl'; @endphp

<section
    class="page-hero page-hero--image"
    style="--page-hero-image: url('{{ asset('assets/client/images/poorten/hero-poorten.webp') }}')"
>
    <div class="client-container">
        <div class="page-hero-content">
            <a href="/{{ $locale }}" class="page-back-link" aria-label="{{ __('site.back_home') }}">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                {{ __('site.back') }}
            </a>
            <span class="section-eyebrow">{{ __('pages.poorten_eyebrow') }}</span>
            <h1 class="page-hero-title">{{ __('pages.poorten_heading') }}</h1>
            <p class="page-hero-intro">{{ __('pages.poorten_intro') }}</p>
        </div>
    </div>
</section>

@php $galleryTitle = __('pages.poorten_gallery'); @endphp
@include('partials.realisaties-gallery')

@endsection
