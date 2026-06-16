@extends('layouts.client')

@section('page_title', 'Contact — Schrijnwerkerij Van Kerkhoven Huldenberg')
@section('page_description', 'Neem contact op met Algemene Schrijnwerkerij Van Kerkhoven in Huldenberg. Vraag een afspraak aan voor ramen, deuren, trappen of maatwerk in massief hout.')

@section('content')

{{-- ─── Minimal page header — no hero styling, just navigation + title ─── --}}
<div class="contact-page-header">
    <div class="client-container">
        <a href="/" class="page-back-link" aria-label="Terug naar home">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Terug naar home
        </a>
    </div>
</div>

{{-- ─── Contact form section ────────────────────────────────────────────── --}}
@include('sections.contact')

{{-- ─── Location ────────────────────────────────────────────────────────── --}}
@if(config('site.sections.location', true))
    @include('sections.location')
@endif

@endsection
