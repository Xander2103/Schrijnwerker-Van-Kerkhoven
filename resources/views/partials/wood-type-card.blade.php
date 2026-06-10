<article class="wood-type-card wood-hub-card reveal">

    <div class="wood-type-image wood-type-image-fallback"
         @if(!empty($wood['image']))
             style="background-image:url('{{ asset($wood['image']) }}');background-color:{{ $wood['tone_color'] }}20;"
         @else
             style="background: linear-gradient(135deg, {{ $wood['tone_color'] }}55 0%, {{ $wood['tone_color'] }}22 100%);"
         @endif
         role="img"
         aria-label="{{ $wood['name'] }}"
    ></div>

    <div class="wood-type-body">
        <h2 class="wood-type-name">{{ $wood['name'] }}</h2>
        <p class="wood-type-description">{{ $wood['description'] }}</p>

        <div class="wood-type-meta">
            <p class="wood-meta-label">Geschikt voor</p>
            <ul class="wood-best-for-list" role="list">
                @foreach($wood['best_for'] as $use)
                    <li>{{ $use }}</li>
                @endforeach
            </ul>
        </div>

        <p class="wood-tone-note">
            <span class="wood-tone-dot" style="background-color:{{ $wood['tone_color'] }};" aria-hidden="true"></span>
            {{ $wood['tone'] }}
        </p>
    </div>

</article>
