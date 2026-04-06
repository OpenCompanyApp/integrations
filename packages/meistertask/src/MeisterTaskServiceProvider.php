<?php

namespace OpenCompany\Integrations\MeisterTask;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MeisterTaskServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MeisterTaskService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MeisterTaskService(
                accessToken: $creds->get('meistertask', 'access_token', ''),
                baseUrl: $creds->get('meistertask', 'url', 'https://www.meistertask.com/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MeisterTaskToolProvider());
        }
    }
}
