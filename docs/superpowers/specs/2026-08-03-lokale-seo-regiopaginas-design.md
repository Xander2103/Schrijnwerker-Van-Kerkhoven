# Sprint 1 — Lokale SEO-regiopagina's (design)

Datum: 2026-08-03

## Doel

Zes lokale landingspagina's (Huldenberg, Overijse, Hoeilaart, Tervuren, Bertem, Leuven)
in NL, FR en EN, volledig geïntegreerd in de bestaande Laravel-architectuur.

## Bestaande architectuur (geanalyseerd)

| Onderdeel | Bestaand |
|---|---|
| Routing | `routes/web.php`: `Route::prefix('{locale}')->where(locale => nl\|fr\|en)->middleware(SetLocale)` |
| Locale | `App\Http\Middleware\SetLocale` zet `App::setLocale()` en deelt `locale` + `localeUrls` via `View::share()` |
| Vertaalde slugs | Bestaande conventie: aparte route per taalslug (`poorten` / `portails` / `gates`), met `localeUrls` override in de view-data |
| Layout | `resources/views/layouts/client.blade.php` — title, description, canonical, hreflang (nl-BE/fr-BE/en/x-default), OG, Twitter, `Carpenter` JSON-LD, `@stack('head')` |
| OG-image | `config/seo.php` → `page_images[<routenaam>]`, fallback `og_image` |
| Sitemap | `App\Http\Controllers\SitemapController` — const `PAGES` (9 logische pagina's × 3 locales = 27 URL's) + `resources/views/sitemap.blade.php` |
| Content | `lang/{nl,fr,en}/{site,pages,contact,privacy}.php` |
| Styling | Tailwind v4 (`@layer components` + `@apply`) in `resources/css/client-site.css`; klassen `page-hero--image`, `client-section`, `section-eyebrow`, `section-title`, `btn btn-primary/secondary`, `info-card`, `page-highlight-list`, `page-cta-row`, `wood-bg-*` |
| Tests | PHPUnit feature tests, `#[DataProvider]`, `withoutVite()` |

Geen bestaande "werkregio"-data, geen bestaande breadcrumbs, geen bestaande FAQ-component.

## Gekozen implementatie: configuratiegestuurd, één route, één template

Zes × drie losse Blade-bestanden zijn expliciet uitgesloten. In plaats daarvan:

1. **`config/regions.php`** — structurele feiten per regio: key, per-locale slug, hero-image,
   realisatie-galerij (bestaande `GalleryScanner`-map), OG-image.
2. **`lang/{nl,fr,en}/regions.php`** — alle copy (metadata, hero, intro, dienstblurbs,
   werkwijze-intro, lokaal, realisaties, FAQ, CTA). Gedeelde labels onder `common`,
   regio-specifiek onder `items.<key>`.
3. **`App\Http\Controllers\RegionController`** — resolvet regio op (locale, slug).
   Slug die niet bij de actieve locale hoort ⇒ 404 (geen indexeerbare fallback-slug).
   Bouwt `localeUrls` met de correcte slug per taal.
4. **Eén route** binnen de bestaande locale-groep, na alle statische routes,
   met een `where`-constraint die uit `config('regions')` wordt opgebouwd:
   `Route::get('/{region}', [RegionController::class, 'show'])->name('region')`.
5. **`resources/views/pages/regio.blade.php`** — één template, alle secties.

### URL's

| Regio | NL | FR | EN |
|---|---|---|---|
| Huldenberg | `/nl/schrijnwerker-huldenberg` | `/fr/menuisier-huldenberg` | `/en/carpenter-huldenberg` |
| Overijse | `/nl/schrijnwerker-overijse` | `/fr/menuisier-overijse` | `/en/carpenter-overijse` |
| Hoeilaart | `/nl/schrijnwerker-hoeilaart` | `/fr/menuisier-hoeilaart` | `/en/carpenter-hoeilaart` |
| Tervuren | `/nl/schrijnwerker-tervuren` | `/fr/menuisier-tervuren` | `/en/carpenter-tervuren` |
| Bertem | `/nl/schrijnwerker-bertem` | `/fr/menuisier-bertem` | `/en/carpenter-bertem` |
| Leuven | `/nl/schrijnwerker-leuven` | `/fr/menuisier-leuven` | `/en/carpenter-leuven` |

Vertaalde slug per taal volgt exact de bestaande `poorten/portails/gates`-conventie.
Geen trailing slash (zoals de rest van de site). Geen redirects.

## Paginaopbouw

1. Hero (`page-hero--image`) — breadcrumbs, eyebrow, **exact één `<h1>`**, intro, CTA contact + CTA realisaties.
2. Lokale introductie — vanuit het atelier in Huldenberg, waarom deze regio relevant is.
3. Diensten in deze regio — links naar `/{locale}/ramen`, `/deuren`, `/trappen`,
   `poorten|portails|gates`, `schuiframen|coulissants|sliding-windows`, `/werkplaats`.
4. Werkwijze — 7 stappen: contact, bespreking, opmeting, voorstel, voorbereiding, plaatsing, opvolging.
5. Waarom lokaal werken — persoonlijk contact, rechtstreeks overleg, maatwerk, opvolging.
6. Realisaties — bestaande foto's via `GalleryScanner`, neutraal gelabeld (géén claim "project in gemeente X").
7. FAQ — 5 vragen per regio, `<details>`/`<summary>`, semantisch en toetsenbordtoegankelijk.
8. CTA — `page-cta-row` naar contact.

## Metadata & structured data

- Unieke `title` (~50–60 tekens) en `description` (~140–160 tekens) per regio per taal.
- Canonical + hreflang via bestaande layout (`localeUrls` uit de controller).
- OG-image per regio via nieuwe view-variabele `$ogImage` (kleine, terugwaarts compatibele
  uitbreiding van de layout: `$ogImage ?? config('seo.page_images.<route>') ?? config('seo.og_image')`).
- `@push('head')`: `WebPage`, `BreadcrumbList`, `FAQPage` — via `json_encode` met
  `JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT` zodat de JSON-LD veilig is.
- Géén tweede `LocalBusiness`/vestiging, géén adres, géén geo, géén rating, géén openingsuren.

## Breadcrumbs

`Home > Werkregio > Schrijnwerker <Gemeente>`, waarbij "Werkregio" naar de nieuwe
compacte homepage-sectie `#werkregio` linkt. `<nav aria-label>` + `<ol>`, zichtbaar en
mobiel bruikbaar, met corresponderend `BreadcrumbList`.

## Interne links

- **Eén** nieuwe navigatieplek: compacte sectie `sections/werkregio.blade.php` op de homepage
  (zes links, geen keyword-blok). Achter `config('site.sections.werkregio')`.
- Contactpagina: één regel met de zes regio's onder de contactsectie.
- Nav en footer blijven onaangeroerd (navigatiecompactheid).
- Elke regiopagina linkt naar contact, ramen, deuren, trappen, poorten, schuiframen, werkplaats
  en de andere vijf regio's.

## Sitemap

`SitemapController::PAGES` krijgt zes extra entries met per-locale slug.
15 logische pagina's × 3 locales = **45 URL's** (was 27). `SitemapTest` wordt aangepast.

## Afbeeldingen

Zes verschillende bestaande hero's — `hero.webp`, `ramen/hero-ramen.webp`,
`schuiframen/hero-schuiframen.webp`, `deuren/hero-deuren.webp`, `poorten/hero-poorten.webp`,
`trappen-hero.webp`. Hero als CSS-achtergrond (bestaand patroon, niet lazy).
Realisatiefoto's `loading="lazy"` met `width`/`height`. Geen nieuwe bestanden.

## Tests

Nieuw `tests/Feature/RegionPagesTest.php`: routes 200 per taal, 404 op onbekende regio en
op locale-slug-mismatch, taalwissel, unieke title/description, canonical, hreflang, één `<h1>`,
geldige JSON-LD met `BreadcrumbList` + `FAQPage`, interne links, unieke content per regio,
bereikbaarheid vanaf homepage/contact. `SitemapTest` 27 → 45.

## Menselijke goedkeuring nodig

De site legt nergens een werkgebied vast. De zes gemeenten komen uit de sprintopdracht,
niet uit bestaande configuratie. De klant moet bevestigen dat hij in deze zes gemeenten werkt
voordat dit live gaat.
