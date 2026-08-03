# Realisaties (projectpagina's)

Handleiding om een project toe te voegen, te vertalen en te publiceren.
Er is bewust géén adminpaneel: een project bestaat uit foto's, één configuratieblok
en drie vertaalblokken.

## In het kort

1. Zet de foto's klaar (zie [Afbeeldingen](#afbeeldingen)).
2. Voeg een blok toe aan `config/projects.php` onder `items`, met `status => 'draft'`.
3. Voeg de vertaalde tekst toe in `lang/nl/projects.php`, `lang/fr/projects.php` en `lang/en/projects.php` onder `items`.
4. Zet `status` op `'published'` zodra alle publicatiecriteria voldaan zijn.
5. Draai `php artisan test --filter=ProjectPagesTest`.

Route, sitemap, breadcrumbs, hreflang, structured data en de interne links
volgen automatisch. Er is nergens anders iets aan te passen.

## Draft versus published

| | `draft` | `published` |
|---|---|---|
| Publieke route | nee (404) | ja |
| Sitemap | nee | ja |
| Realisatie-index | nee | ja |
| Links op dienst-/regiopagina's | nee | ja |
| Indexeerbaar | nooit | ja |

Een draft bestaat dus alleen in de configuratie. `App\Support\Projects::published()`
is de enige bron voor alles wat publiek is; `all()` bestaat uitsluitend voor de
configuratietests.

## Publicatiecriteria

Een project mag pas op `published` wanneer **alles** hieronder klopt. De tests
in `tests/Feature/ProjectPagesTest.php` dwingen dit af.

- `service` verwijst naar een bestaande hoofddienst uit `config/service-pages.php` → `core`.
- Minstens **drie** foto's die aantoonbaar bij hetzelfde project horen (`Projects::MIN_PHOTOS`).
- `hero` bestaat op schijf.
- Alle `gallery`-bestanden bestaan op schijf.
- In **elke** taal (nl/fr/en) ingevuld: `title`, `intro`, `hero_alt`, `meta_title`, `meta_description`.
- In **elke** taal ingevuld als array met minstens één alinea: `challenge`, `approach`, `result`.

Ontbreekt er iets? Laat het project op `draft` staan en beschrijf in het veld
`missing` precies wat er nog nodig is.

### "Aantoonbaar bij hetzelfde project"

Groepeer foto's niet op visuele gelijkenis. Twee foto's van een gelijkaardige
deur zijn geen bewijs; twee foto's van hetzelfde pand wel. Bruikbaar bewijs is
bijvoorbeeld: dezelfde gevel, hetzelfde interieur, dezelfde omgeving zichtbaar
op meerdere beelden, of bevestiging door de klant. Noteer het bewijs in het veld
`evidence`.

## Configuratievelden

Verplicht:

| Veld | Type | Toelichting |
|---|---|---|
| `status` | `'draft'` \| `'published'` | |
| `slugs` | array nl/fr/en | kleine letters, cijfers en koppeltekens; uniek binnen elke taal |
| `service` | string | sleutel uit `service-pages.core` |
| `hero` | string | pad onder `public/` |
| `gallery` | array | paden onder `public/` |
| `region` | string \| `null` | **alleen** invullen bij bevestigde gemeente |
| `year` | string \| `null` | **alleen** invullen indien bevestigd |
| `materials` | array | leeg laten indien niet bevestigd |

Optioneel:

| Veld | Type | Toelichting |
|---|---|---|
| `subservice` | string \| `null` | sleutel uit `service-pages.items` |
| `work_type` | `'renovation'` \| `'new_build'` \| `null` | alleen indien bevestigd |
| `related_projects` | array van projectsleutels | wordt aangevuld met projecten van dezelfde dienst |
| `evidence` | string | interne notitie, wordt nergens gerenderd |
| `missing` | array | interne notitie, wordt nergens gerenderd |

`region`, `year`, `materials` en `work_type` worden **volledig verborgen** wanneer
ze leeg zijn — geen streepje, geen "onbekend", geen lege rij. Vul ze dus nooit
met een gok.

## Vertaalvelden

Onder `items.{projectsleutel}` in elk van de drie `lang/*/projects.php`:

Verplicht: `title`, `intro`, `hero_alt`, `meta_title`, `meta_description`,
`challenge` (array), `approach` (array), `result` (array).

Optioneel: `execution` (array), `highlights` (array), `gallery_alts` (array, in
dezelfde volgorde als `gallery`), `faq` (array van `['q' => ..., 'a' => ...]`).

Zonder `gallery_alts` blijven de foto's decoratief (`alt=""`) en houdt de
lightbox-knop haar generieke label — dat is een geldig toegankelijkheidspatroon,
maar echte beschrijvingen zijn beter.

## Slugregels

- Alleen `a-z`, `0-9` en `-`.
- Per taal een natuurlijke slug, geen letterlijke vertaling van het Nederlands.
- Uniek binnen elke taal.
- De slug van een andere taal geeft 404 — `/nl/realisaties/{engelse-slug}` bestaat niet.

URL-structuur:

```
/nl/realisaties/{slug}
/fr/realisations/{slug}
/en/projects/{slug}
```

Het eerste segment komt uit `config/projects.php` → `index_slugs`.

## Afbeeldingen

Voor **nieuwe** projecten:

```
public/assets/client/images/projects/{project-key}/hero.webp
public/assets/client/images/projects/{project-key}/01.webp
public/assets/client/images/projects/{project-key}/02.webp
```

Voor projecten die bestaande foto's hergebruiken: verwijs vanuit de config naar
het bestaande pad. Bestanden uit `images/ramen/`, `images/deuren/` enzovoort
worden **niet** verplaatst — `App\Support\GalleryScanner` leest die mappen uit
voor de categoriegalerijen, en verplaatsen zou die pagina's breken. Zo staat
dezelfde foto nooit twee keer op schijf.

Richtlijnen: geen nieuwe compressie over bestaand materiaal, geen agressieve
crop, natuurlijke beeldverhouding. De galerij gebruikt een kolommenlayout die de
verhouding van elke foto respecteert.

## Koppeling aan diensten

`service` is de primaire dienst, `subservice` de verdiepende pagina. Beide
verschijnen in de projectgegevens en onderaan bij "Diensten bij dit project".

Omgekeerd verschijnt het project automatisch in de sectie "Gerelateerde
realisaties" op:

- de hoofddienstpagina (`/nl/ramen`, `/nl/deuren`, …);
- de subdienstpagina (`/nl/houten-ramen`, …).

Die sectie rendert **niets** wanneer er geen gepubliceerd project aan hangt.

Koppel `aluminium-ramen` alleen wanneer het project aantoonbaar aluminium toont.
Materiaal is geen visuele gok.

## Koppeling aan regio's

Vul `region` uitsluitend in wanneer de klant de gemeente bevestigd heeft. Dan:

- staat de gemeente in de hero, in de projectgegevens en op de projectkaart;
- verschijnt het project in "Gerelateerde realisaties" op die regiopagina;
- linken project en regio wederzijds.

Zonder bevestiging: `region => null`. De gemeente komt dan nergens voor — ook
niet in de metadata en ook niet als vage omschrijving.

## Relevante tests

```bash
php artisan test --filter=ProjectPagesTest   # configuratie, routes, SEO, JSON-LD, links
php artisan test --filter=SitemapTest        # index + gepubliceerde projecten, drafts afwezig
php artisan test                             # volledige suite, geen regressies
```

`ProjectPagesTest` valideert de echte configuratie en draait de gepubliceerde
route daarnaast tegen een geïnjecteerd testproject. Daardoor blijft het volledige
publicatiepad gedekt, ook zolang er nog niets echt gepubliceerd is.
