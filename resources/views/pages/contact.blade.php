@extends('layouts.client')

@section('page_title', __('pages.contact_title'))
@section('page_description', __('pages.contact_desc'))

@section('content')

@php $locale ??= 'nl'; @endphp

<div class="contact-page-header">
    <div class="client-container">
        <a href="/{{ $locale }}" class="page-back-link" aria-label="{{ __('pages.contact_back') }}">
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M10 12L6 8l4-4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            {{ __('pages.contact_back') }}
        </a>
    </div>
</div>

@include('sections.contact')

@if(config('site.sections.location', true))
    @include('sections.location')
@endif

@endsection
