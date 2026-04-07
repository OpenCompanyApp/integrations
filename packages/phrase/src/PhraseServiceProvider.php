<?php

namespace OpenCompany\Integrations\Phrase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the PhraseService singleton and bootstraps Phrase tools.
 */
class PhraseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PhraseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new PhraseService(
                accessToken: $creds->get('phrase', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PhraseToolProvider());
        }
    }
}
