@php
    $locale ??= 'nl';
    $regionLinks = \App\Support\Regions::links($locale);
@endphp

@if(count($regionLinks) > 0)
    <section id="werkregio" class="client-section werkregio-section">
        <div class="client-container">
            <div class="werkregio-inner reveal">

                <span class="section-eyebrow">{{ __('regions.common.section_eyebrow') }}</span>
                <h2 class="section-title">{{ __('regions.common.section_heading') }}</h2>
                <p style="color:var(--color-text-light);line-height:1.7;margin:0;">
                    {{ __('regions.common.section_text') }}
                </p>

                <ul class="werkregio-list" role="list">
                    @foreach($regionLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">
                                {{ __('regions.common.section_link', ['city' => $link['name']]) }}
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </section>
@endif
