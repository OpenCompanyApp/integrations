<?php

namespace OpenCompany\Integrations\CloudConvert;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the CloudConvert integration with Laravel's service container.
 *
 * Binds the CloudConvert API client from host credentials and registers the
 * provider when the integration registry is available.
 */
class CloudConvertServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CloudConvertService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CloudConvertService(
                apiKey: (string) $creds->get('cloudconvert', 'api_key', ''),
                baseUrl: (string) $creds->get('cloudconvert', 'url', 'https://api.cloudconvert.com/v2'),
                syncBaseUrl: (string) $creds->get('cloudconvert', 'sync_url', 'https://sync.api.cloudconvert.com/v2'),
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
