<?php

namespace OpenCompany\Integrations\Huggingface;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HuggingfaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HuggingfaceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HuggingfaceService(
                accessToken: $creds->get('huggingface', 'access_token', ''),
                baseUrl: $creds->get('huggingface', 'url', 'https://huggingface.co/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HuggingfaceToolProvider());
        }
    }
}
