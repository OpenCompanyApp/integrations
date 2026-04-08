<?php

namespace OpenCompany\Integrations\PayloadCms;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the PayloadCmsService singleton and bootstraps Payload CMS tools.
 */
class PayloadCmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PayloadCmsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PayloadCmsService(
                apiToken: $creds->get('payload-cms', 'api_token', ''),
                baseUrl: $creds->get('payload-cms', 'base_url', 'https://api.payloadcms.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PayloadCmsToolProvider());
        }
    }
}
