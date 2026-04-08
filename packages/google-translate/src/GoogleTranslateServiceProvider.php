<?php

namespace OpenCompany\Integrations\GoogleTranslate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class GoogleTranslateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(GoogleTranslateService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new GoogleTranslateService(
                apiKey: $creds->get('google-translate', 'api_key', ''),
                baseUrl: $creds->get('google-translate', 'base_url', 'https://translation.googleapis.com/language/translate/v2'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new GoogleTranslateToolProvider());
        }
    }
}
