<?php

namespace OpenCompany\Integrations\AdobeAcrobatSign;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Adobe Acrobat Sign integration with Laravel's service container.
 *
 * Binds AdobeAcrobatSignService from host credentials and registers the tool
 * provider with the shared registry when available.
 */
class AdobeAcrobatSignServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AdobeAcrobatSignService::class, function ($app): AdobeAcrobatSignService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;
            return new AdobeAcrobatSignService(
                accessToken: $creds?->get('adobe-acrobat-sign', 'access_token', '') ?? '',
                baseUrl: $creds?->get('adobe-acrobat-sign', 'api_url', 'https://api.na1.adobesign.com/api/rest/v6') ?? 'https://api.na1.adobesign.com/api/rest/v6',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new AdobeAcrobatSignToolProvider);
        }
    }
}