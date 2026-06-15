@extends('layouts.client')

@section('content')

<section class="client-section houtsoorten-hero wood-bg-sand">
    <div class="client-container">
        <div class="section-header">
            <span class="section-eyebrow">Juridisch</span>
            <h1 class="section-title">Privacybeleid</h1>
            <p class="section-intro">
                {{ config('site.name') }} hecht waarde aan uw privacy en gaat zorgvuldig om met uw persoonsgegevens.
                Hieronder vindt u een overzicht van welke gegevens wij verzamelen, waarvoor wij ze gebruiken en wat uw rechten zijn.
            </p>
        </div>
    </div>
</section>

<section class="client-section wood-bg-ivory">
    <div class="client-container">
        <div class="privacy-content">

            <div class="privacy-block">
                <h2>1. Wie zijn wij?</h2>
                <p>
                    <strong>{{ config('site.name') }}</strong><br>
                    {{ config('site.address') }}, {{ config('site.city') }}<br>
                    BTW: {{ config('site.vat') }}<br>
                    @if(!empty(config('site.phone')))
                        Telefoon: <a href="tel:{{ config('site.phone') }}">{{ config('site.phone') }}</a><br>
                    @endif
                    @if(!empty(config('contact.email')))
                        E-mail: <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    @endif
                </p>
            </div>

            <div class="privacy-block">
                <h2>2. Welke gegevens verzamelen wij?</h2>
                <p>Wanneer u het contactformulier op onze website invult, verzamelen wij de volgende gegevens:</p>
                <ul class="privacy-list">
                    <li>Uw naam</li>
                    <li>Uw telefoonnummer</li>
                    <li>Uw e-mailadres (optioneel)</li>
                    <li>Het type aanvraag en uw bericht</li>
                </ul>
                <p>Wij verzamelen geen andere persoonsgegevens, tenzij u deze zelf meedeelt.</p>
            </div>

            <div class="privacy-block">
                <h2>3. Waarvoor gebruiken wij uw gegevens?</h2>
                <p>Uw contactgegevens worden uitsluitend gebruikt om uw aanvraag te beantwoorden. Wij kunnen contact met u opnemen via telefoon of e-mail om uw vraag te bespreken of een afspraak in te plannen.</p>
                <p>Uw gegevens worden <strong>niet verkocht</strong> aan derden en niet gebruikt voor marketing zonder uw uitdrukkelijke toestemming.</p>
            </div>

            <div class="privacy-block">
                <h2>4. Hoe lang bewaren wij uw gegevens?</h2>
                <p>Uw gegevens worden niet langer bewaard dan noodzakelijk voor het afhandelen van uw aanvraag, tenzij een wettelijke bewaarplicht van toepassing is (bijv. boekhoudkundige documenten).</p>
            </div>

            <div class="privacy-block">
                <h2>5. Cookies, technische gegevens en externe diensten</h2>
                <p>Deze website maakt gebruik van functionele sessiedata die nodig zijn voor de werking van het contactformulier (CSRF-beveiliging). Er worden geen tracking- of advertentiecookies geplaatst. Er wordt geen gebruik gemaakt van Google Analytics of andere analysediensten.</p>
                <p><strong>Lettertypen (Google Fonts):</strong> De website laadt lettertypen van Google Fonts (fonts.googleapis.com). Hierdoor kan uw IP-adres worden doorgestuurd naar servers van Google. Google verwerkt deze gegevens conform hun eigen privacybeleid. Wij hebben geen toegang tot deze gegevens en gebruiken ze niet voor profilering.</p>
                <p><strong>Google Maps:</strong> Op de pagina 'Locatie' wordt een kaart getoond via een ingebedde Google Maps-kaart (iframe). Wanneer u die pagina bezoekt, kan Google uw IP-adres en browserinformatie verwerken. Dit geschiedt conform het privacybeleid van Google. U kunt de kaart ook rechtstreeks raadplegen via de link 'Bekijk op Google Maps' zonder de ingebedde versie te laden.</p>
            </div>

            <div class="privacy-block">
                <h2>6. Uw rechten</h2>
                <p>U heeft het recht om:</p>
                <ul class="privacy-list">
                    <li>Inzage te vragen in de persoonsgegevens die wij over u bewaren</li>
                    <li>Onjuiste gegevens te laten corrigeren</li>
                    <li>Uw gegevens te laten verwijderen</li>
                    <li>Bezwaar te maken tegen de verwerking van uw gegevens</li>
                </ul>
                <p>
                    Neem hiervoor contact op via
                    @if(!empty(config('contact.email')))
                        <a href="mailto:{{ config('contact.email') }}">{{ config('contact.email') }}</a>
                    @else
                        de contactgegevens bovenaan deze pagina
                    @endif.
                    Wij behandelen uw verzoek zo snel mogelijk en uiterlijk binnen 30 dagen.
                </p>
            </div>

            <div class="privacy-block">
                <h2>7. Klachten</h2>
                <p>Als u van mening bent dat wij uw persoonsgegevens niet correct verwerken, kunt u een klacht indienen bij de Gegevensbeschermingsautoriteit (GBA): <a href="https://www.gegevensbeschermingsautoriteit.be" target="_blank" rel="noopener noreferrer">www.gegevensbeschermingsautoriteit.be</a>.</p>
            </div>

            <div class="privacy-block privacy-block--note">
                <p><em>Dit privacybeleid is opgesteld in eenvoudige taal en geeft een eerlijk beeld van hoe wij met uw gegevens omgaan. Voor een professionele juridische review van dit document kunt u een advocaat of privacyexpert raadplegen.</em></p>
            </div>

            <div class="section-actions" style="margin-top:2rem;">
                <a href="/" class="btn btn-secondary">Terug naar home</a>
                @if(!empty(config('site.phone')))
                    <a href="tel:{{ config('site.phone') }}" class="btn btn-primary">{{ config('site.phone') }}</a>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection
