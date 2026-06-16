@extends('layouts.client')

@section('page_title', 'Houten deuren op maat — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Massief houten deuren op maat — buitendeuren en binnendeuren in elke stijl en afwerking. Van Kerkhoven — 45 jaar vakmanschap in Huldenberg.')

@section('content')

{{-- ─── Page hero with background image ──────────────────────────── --}}
<section
    class="page-hero page-hero--image"
    style="--page-hero-image: url('{{ asset('assets/client/images/deuren/hero-deuren.webp') }}')"
>
    <div class="client-container">
        <div class="page-hero-content">
            <a href="/" class="page-back-link" aria-label="Terug naar home">
                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Terug
            </a>
            <span class="section-eyebrow">Specialisatie</span>
            <h1 class="page-hero-title">Houten deuren met karakter</h1>
            <p class="page-hero-intro">Van een solide voordeur tot stijlvolle binnendeuren — elk op maat, in massief hout.</p>
        </div>
    </div>
</section>

{{-- ─── Photo gallery ───────────────────────────────────────────────── --}}
@php $galleryTitle = 'Realisaties houten deuren'; @endphp
@include('partials.realisaties-gallery')

@endsection
