<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->forceHttpsWhenConfigured();
        $this->configureContactRateLimiter();
    }

    /**
     * When APP_URL is https, generate every URL as https.
     *
     * asset() and url() otherwise follow the scheme of the incoming request,
     * which behind a TLS-terminating proxy is http. That would put http:// in
     * og:image and in the schema.org @id while the canonical says https://.
     */
    private function forceHttpsWhenConfigured(): void
    {
        if (Str::startsWith((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }
    }

    /**
     * Contact form: per-IP limits (the literal requirement) plus a stricter
     * IP+email-hash combo limit so repeat abuse from one sender is caught
     * tighter than the broad per-IP allowance, without ever logging the
     * raw e-mail address itself.
     */
    private function configureContactRateLimiter(): void
    {
        RateLimiter::for('contact', function (Request $request) {
            $ip = (string) $request->ip();
            $normalizedEmail = Str::lower(trim((string) $request->input('email')));

            $limits = [
                Limit::perMinute((int) config('contact.rate_limit.per_minute', 3))
                    ->by('contact-min:' . $ip),
                Limit::perDay((int) config('contact.rate_limit.per_day', 10))
                    ->by('contact-day:' . $ip),
            ];

            if ($normalizedEmail !== '') {
                $limits[] = Limit::perDay((int) config('contact.rate_limit.per_day_combo', 5))
                    ->by('contact-combo:' . $ip . ':' . hash('sha256', $normalizedEmail));
            }

            return $limits;
        });
    }
}
