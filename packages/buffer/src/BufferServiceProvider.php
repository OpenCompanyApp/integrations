<?php

namespace OpenCompany\Integrations\Buffer;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class BufferServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BufferService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new BufferService(
                accessToken: $creds->get('buffer', 'access_token', ''),
                baseUrl: $creds->get('buffer', 'url', 'https://api.bufferapp.com/1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new BufferToolProvider());
        }
    }
}
