<?php

namespace OpenCompany\Integrations\Baserow;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BaserowServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BaserowService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BaserowService(
                accessToken: $creds->get('baserow', 'access_token', ''),
                baseUrl: $creds->get('baserow', 'url', 'https://api.baserow.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BaserowToolProvider());
        }
    }
}
