<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        $this->configureContactRateLimiter();
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
                Limit::perHour((int) config('contact.rate_limit.per_hour', 10))
                    ->by('contact-hour:' . $ip),
            ];

            if ($normalizedEmail !== '') {
                $limits[] = Limit::perHour((int) config('contact.rate_limit.per_hour_combo', 5))
                    ->by('contact-combo:' . $ip . ':' . hash('sha256', $normalizedEmail));
            }

            return $limits;
        });
    }
}
