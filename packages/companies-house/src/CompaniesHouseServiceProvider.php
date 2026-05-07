<?php

namespace OpenCompany\Integrations\CompaniesHouse;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Companies House integration with Laravel's service container.
 *
 * Binds CompaniesHouseService using host credentials and registers the
 * CompaniesHouseToolProvider with the ToolProviderRegistry during boot.
 */
class CompaniesHouseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CompaniesHouseService::class, function ($app): CompaniesHouseService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new CompaniesHouseService(apiKey: $creds?->get('companies-house', 'api_key', '') ?? '');
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CompaniesHouseToolProvider);
        }
    }
}
