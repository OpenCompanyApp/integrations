<?php

namespace OpenCompany\Integrations\Qualifying;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class QualifyingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(QualifyingService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new QualifyingService(
                accessToken: $creds->get('qualifying', 'access_token', ''),
                baseUrl: $creds->get('qualifying', 'url', 'https://api.qualifying.ai'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new QualifyingToolProvider());
        }
    }
}
