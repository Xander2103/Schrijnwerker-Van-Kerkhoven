@extends('layouts.client')

@section('page_title', 'Onze werkplaats — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Bekijk de werkplaats van Algemene Schrijnwerkerij Van Kerkhoven in Huldenberg. Eigen machines, ervaren handen en productie van ramen, deuren en trappen op maat.')

@section('content')

    @include('sections.atelier', [
        'atelierId'    => 'werkplaats',
        'atelierVariant' => 'atelier-section--light',
        'atelierEyebrow' => 'Eigen werkplaats',
        'atelierTitle'   => 'Waar vakmanschap vorm krijgt',
        'atelierIntro'   => 'In onze werkplaats in Huldenberg krijgt elk project vorm. Van voorbereiding tot afwerking werken we met eigen machines, ervaren handen en oog voor detail. Zo houden we controle over kwaliteit, planning en afwerking.',
    ])

    <div class="client-container">
        <div class="section-actions" style="padding-bottom:3rem;">
            <a href="/contact" class="btn btn-primary">Neem contact op</a>
            <a href="/" class="btn btn-secondary">Terug naar home</a>
        </div>
    </div>

@endsection
