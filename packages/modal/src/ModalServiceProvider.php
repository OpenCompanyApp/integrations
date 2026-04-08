<?php

namespace OpenCompany\Integrations\Modal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider that registers the ModalService singleton and bootstraps Modal tools.
 */
class ModalServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ModalService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new ModalService(
                apiKey: $creds->get('modal', 'api_key', ''),
                baseUrl: $creds->get('modal', 'url', 'https://api.modal.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ModalToolProvider());
        }
    }
}
