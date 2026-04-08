<?php

namespace OpenCompany\Integrations\CloudConvert;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CloudConvertServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CloudConvertService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CloudConvertService(
                apiKey: $creds->get('cloudconvert', 'api_key', ''),
                baseUrl: $creds->get('cloudconvert', 'url', 'https://api.cloudconvert.com/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CloudConvertToolProvider());
        }
    }
}
