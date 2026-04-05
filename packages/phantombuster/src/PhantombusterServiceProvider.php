<?php

namespace OpenCompany\Integrations\Phantombuster;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PhantombusterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PhantombusterService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PhantombusterService(
                apiKey: $creds->get('phantombuster', 'api_key', ''),
                baseUrl: $creds->get('phantombuster', 'url', 'https://api.phantombuster.com/api/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PhantombusterToolProvider());
        }
    }
}
