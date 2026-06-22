@extends('layouts.client')

@section('page_title', __('pages.privacy_title'))

@section('content')

@php $locale ??= 'nl'; @endphp

<section class="client-section houtsoorten-hero wood-bg-sand">
    <div class="client-container">
        <div class="section-header">
            <span class="section-eyebrow">{{ __('pages.privacy_eyebrow') }}</span>
            <h1 class="section-title">{{ __('pages.privacy_heading') }}</h1>
            <p class="section-intro">
                {{ __('privacy.intro', ['name' => config('site.name')]) }}
            </p>
        </div>
    </div>
</section>

<section class="client-section wood-bg-ivory">
    <div class="client-container">
        <div class="privacy-content">

            {{-- 1. Who are we? --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h1') }}</h2>
                <p>
                    <strong>{{ config('site.name') }}</strong><br>
                    {{ config('site.address') }}, {{ config('site.city') }}<br>
                    {{ __('privacy.vat_label') }}: {{ config('site.vat') }}<br>
                    @if(!empty(config('site.phone')))
                        {{ __('site.label_phone') }}: <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a><br>
                    @endif
                    @if(!empty(config('contact.email')))
                        {{ __('site.label_email') }}: <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    @endif
                </p>
            </div>

            {{-- 2. What data do we collect? --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h2') }}</h2>
                <p>{{ __('privacy.h2_body') }}</p>
                <ul class="privacy-list">
                    @foreach(__('privacy.h2_list') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <p>{{ __('privacy.h2_after') }}</p>
            </div>

            {{-- 3. Why do we use your data? --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h3') }}</h2>
                <p>{{ __('privacy.h3_body') }}</p>
                <p>{!! __('privacy.h3_body2') !!}</p>
            </div>

            {{-- 4. How long? --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h4') }}</h2>
                <p>{{ __('privacy.h4_body') }}</p>
            </div>

            {{-- 5. Cookies --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h5') }}</h2>
                <p>{{ __('privacy.h5_body') }}</p>
                <p>{!! __('privacy.h5_body2') !!}</p>
            </div>

            {{-- 6. Your rights --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h6') }}</h2>
                <p>{{ __('privacy.h6_body') }}</p>
                <ul class="privacy-list">
                    @foreach(__('privacy.h6_list') as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
                <p>
                    {!! __('privacy.h6_after', [
                        'contact' => !empty(config('contact.email'))
                            ? '<a href="mailto:' . config('contact.email') . '">' . config('contact.email') . '</a>'
                            : __('privacy.h6_contact_link'),
                    ]) !!}
                </p>
            </div>

            {{-- 7. Complaints --}}
            <div class="privacy-block">
                <h2>{{ __('privacy.h7') }}</h2>
                <p>
                    {{ __('privacy.h7_body') }}
                    <a href="https://www.gegevensbeschermingsautoriteit.be" target="_blank" rel="noopener noreferrer">{{ __('privacy.h7_gba') }}</a>.
                </p>
            </div>

            {{-- Legal review note --}}
            <div class="privacy-block privacy-block--note">
                <p><em>{{ __('privacy.note') }}</em></p>
            </div>

            <div class="section-actions" style="margin-top:2rem;">
                <a href="/{{ $locale }}" class="btn btn-secondary">{{ __('pages.privacy_back') }}</a>
                @if(!empty(config('site.phone')))
                    <a href="tel:{{ config('site.phone') }}" class="btn btn-primary">{{ config('site.phone') }}</a>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection
