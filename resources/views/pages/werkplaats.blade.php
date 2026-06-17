@extends('layouts.client')

@section('page_title', 'Onze werkplaats — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Bekijk de werkplaats van Algemene Schrijnwerkerij Van Kerkhoven in Huldenberg. Eigen machines, ervaren handen en productie van ramen, deuren en trappen op maat.')

@section('content')

    {{-- Intro header --}}
    <section class="werkplaats-intro-section client-section wood-bg-ivory">
        <div class="client-container">
            <div class="werkplaats-intro reveal">
                <span class="section-eyebrow">Eigen werkplaats</span>
                <h1 class="werkplaats-intro-title">Waar vakmanschap vorm krijgt</h1>
                <p class="werkplaats-intro-text">In onze werkplaats in Huldenberg krijgt elk project vorm. Van voorbereiding tot afwerking werken we met eigen machines, ervaren handen en oog voor detail. Zo houden we controle over kwaliteit, planning en afwerking.</p>
            </div>
        </div>
    </section>

    {{-- Full atelier photo gallery --}}
    @php
        $galleryImages = $atelierImages;
        $galleryTitle  = 'Onze werkplaats';
    @endphp
    @include('partials.realisaties-gallery')

@endsection
