<?php

namespace OpenCompany\Integrations\SmartRecruiters;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the SmartRecruiters integration with Laravel's service container.
 *
 * Binds SmartRecruitersService from host credentials and registers the tool
 * provider with the discovery registry when available.
 */
class SmartRecruitersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SmartRecruitersService::class, function ($app): SmartRecruitersService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new SmartRecruitersService(
                apiKey: $creds?->get('smartrecruiters', 'api_key', '') ?? '',
                accessToken: $creds?->get('smartrecruiters', 'access_token', '') ?? '',
                clientId: $creds?->get('smartrecruiters', 'client_id', '') ?? '',
                clientSecret: $creds?->get('smartrecruiters', 'client_secret', '') ?? '',
                baseUrl: $creds?->get('smartrecruiters', 'url', 'https://api.smartrecruiters.com') ?? 'https://api.smartrecruiters.com',
                tokenUrl: $creds?->get('smartrecruiters', 'token_url', 'https://api.smartrecruiters.com/identity/oauth/token') ?? 'https://api.smartrecruiters.com/identity/oauth/token',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new SmartRecruitersToolProvider);
        }
    }
}
