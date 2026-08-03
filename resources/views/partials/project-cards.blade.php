{{--
    Raster met projectkaarten.

    Verwacht $cards (uit App\Support\Projects::cards/forService/forRegion/related).
    De volledige kaart is één link, zodat ze met muis én toetsenbord in één
    keer bereikbaar is; de titel draagt de toegankelijke naam.
--}}
@php $cards ??= []; @endphp

@if(count($cards) > 0)
    <ul class="project-grid" role="list">
        @foreach($cards as $card)
            <li class="project-card">
                <a href="{{ $card['url'] }}" class="project-card-link">
                    <span class="project-card-media">
                        <img
                            src="{{ asset($card['hero']) }}"
                            alt="{{ $card['hero_alt'] }}"
                            loading="lazy"
                            decoding="async"{!! \App\Support\ImageDimensions::attributes($card['hero']) !!}
                        >
                    </span>
                    <span class="project-card-body">
                        <span class="project-card-meta">
                            {{ $card['serviceLabel'] }}@if($card['regionName']) · {{ $card['regionName'] }}@endif
                        </span>
                        <span class="project-card-title">{{ $card['title'] }}</span>
                        <span class="project-card-intro">{{ $card['intro'] }}</span>
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
@endif
