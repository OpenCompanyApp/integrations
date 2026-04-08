<?php

namespace OpenCompany\Integrations\Snowflake;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SnowflakeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SnowflakeService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SnowflakeService(
                accessToken: $creds->get('snowflake', 'access_token', ''),
                account: $creds->get('snowflake', 'account', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SnowflakeToolProvider());
        }
    }
}
