<?php

namespace OpenCompany\Integrations\Codemagic;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Codemagic integration with Laravel.
 *
 * Binds the Codemagic API client from host credentials and registers the tool
 * provider when the shared registry is available.
 */
class CodemagicServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CodemagicService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new CodemagicService(
                apiToken: $creds->get('codemagic', 'api_token', ''),
                baseUrl: $creds->get('codemagic', 'url', 'https://api.codemagic.io'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new CodemagicToolProvider());
        }
    }
}
