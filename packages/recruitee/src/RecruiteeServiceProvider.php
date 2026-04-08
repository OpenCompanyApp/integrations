<?php

namespace OpenCompany\Integrations\Recruitee;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class RecruiteeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(RecruiteeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new RecruiteeService(
                accessToken: $creds->get('recruitee', 'access_token', ''),
                companyId: $creds->get('recruitee', 'company_id', ''),
                baseUrl: $creds->get('recruitee', 'url', 'https://{company}.recruitee.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new RecruiteeToolProvider());
        }
    }
}
