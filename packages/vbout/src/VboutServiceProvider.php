<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the VBOUT integration with Laravel's service container.
 *
 * Binds the VBOUT service using host-managed credentials and registers the
 * tool provider with the shared registry when available.
 */
class VboutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VboutService::class, function ($app): VboutService {
            $creds = $app->make(CredentialResolver::class);

            return new VboutService(
                apiKey: $creds->get('vbout', 'api_key', ''),
                baseUrl: $creds->get('vbout', 'url', 'https://api.vbout.com/1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new VboutToolProvider());
        }
    }
}