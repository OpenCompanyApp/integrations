<?php

namespace OpenCompany\Integrations\Recruitee;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Recruitee integration with Laravel's service container.
 *
 * Binds the company-scoped Recruitee API service and registers the tool provider.
 */
class RecruiteeServiceProvider extends ServiceProvider
{
    /**
     * Register the Recruitee API client singleton.
     */
    public function register(): void
    {
        $this->app->singleton(RecruiteeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RecruiteeService(
                accessToken: $creds->get('recruitee', 'access_token', ''),
                companyId: $creds->get('recruitee', 'company_id', ''),
                baseUrl: $creds->get('recruitee', 'url', 'https://api.recruitee.com/c/{company_id}'),
            );
        });
    }

    /**
     * Register the Recruitee tool provider when the registry is available.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RecruiteeToolProvider());
        }
    }
}
