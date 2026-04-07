<?php

namespace OpenCompany\Integrations\Autopilot;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class AutopilotServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AutopilotService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new AutopilotService(
                apiKey: $creds->get('autopilot', 'api_key', ''),
                baseUrl: $creds->get('autopilot', 'url', 'https://api.autopilotapp.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new AutopilotToolProvider());
        }
    }
}
