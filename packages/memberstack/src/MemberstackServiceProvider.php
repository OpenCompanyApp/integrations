<?php

namespace OpenCompany\Integrations\Memberstack;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MemberstackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MemberstackService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MemberstackService(
                accessToken: $creds->get('memberstack', 'access_token', ''),
                baseUrl: $creds->get('memberstack', 'url', 'https://api.memberstack.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MemberstackToolProvider());
        }
    }
}
