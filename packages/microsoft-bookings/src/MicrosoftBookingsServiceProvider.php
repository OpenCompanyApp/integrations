<?php

namespace OpenCompany\Integrations\MicrosoftBookings;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Bookings integration with Laravel.
 *
 * Binds the Graph-backed Bookings service and registers the tool provider with
 * the shared integration registry when available.
 */
class MicrosoftBookingsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MicrosoftBookingsService::class, function ($app): MicrosoftBookingsService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new MicrosoftBookingsService(accessToken: $creds?->get('microsoft-bookings', 'access_token', '') ?? '', baseUrl: $creds?->get('microsoft-bookings', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0');
        });
    }
    public function boot(): void { if ($this->app->bound(ToolProviderRegistry::class)) { $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftBookingsToolProvider); } }
}
