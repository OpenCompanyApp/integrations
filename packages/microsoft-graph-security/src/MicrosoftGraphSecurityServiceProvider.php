<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Graph Security integration with Laravel.
 *
 * Binds the Graph security service using host-managed OAuth credentials and
 * registers the tool provider with the shared registry when available.
 */
class MicrosoftGraphSecurityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MicrosoftGraphSecurityService::class, function ($app): MicrosoftGraphSecurityService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new MicrosoftGraphSecurityService(
                accessToken: $creds?->get('microsoft-graph-security', 'access_token', '') ?? '',
                baseUrl: $creds?->get('microsoft-graph-security', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftGraphSecurityToolProvider);
        }
    }
}
