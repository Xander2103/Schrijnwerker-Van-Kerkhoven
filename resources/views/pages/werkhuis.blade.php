@extends('layouts.client')

@section('page_title', 'Ons werkhuis — Van Kerkhoven Schrijnwerkerij Huldenberg')
@section('page_description', 'Ontdek het werkhuis van Algemene Schrijnwerkerij Van Kerkhoven in Huldenberg. Eigen machines, ervaren handen en productie van ramen, deuren en trappen op maat.')

@section('content')

    @include('sections.atelier')

    <div class="client-container">
        <div class="section-actions" style="padding-bottom:3rem;">
            @if(!empty(config('site.cta_primary')))
                <a href="/contact" class="btn btn-primary">{{ config('site.cta_primary') }}</a>
            @endif
            <a href="/" class="btn btn-secondary">Terug naar home</a>
        </div>
    </div>

@endsection
