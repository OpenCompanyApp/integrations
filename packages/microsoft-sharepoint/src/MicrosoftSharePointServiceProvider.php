<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft SharePoint integration with Laravel.
 *
 * Binds the Graph service using host-managed OAuth credentials and registers
 * the tool provider with the shared integration registry when available.
 */
class MicrosoftSharePointServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MicrosoftSharePointService::class, function ($app): MicrosoftSharePointService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new MicrosoftSharePointService(
                accessToken: $creds?->get('microsoft-sharepoint', 'access_token', '') ?? '',
                baseUrl: $creds?->get('microsoft-sharepoint', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftSharePointToolProvider);
        }
    }
}
