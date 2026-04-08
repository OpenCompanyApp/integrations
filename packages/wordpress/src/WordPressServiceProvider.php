<?php

namespace OpenCompany\Integrations\WordPress;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the WordPress integration.
 *
 * Registers the WordPressService as a singleton and boots the ToolProvider
 * into the ToolProviderRegistry for auto-discovery.
 */
class WordPressServiceProvider extends ServiceProvider
{
    /**
     * Register the WordPressService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(WordPressService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WordPressService(
                username: $creds->get('wordpress', 'username', ''),
                applicationPassword: $creds->get('wordpress', 'application_password', ''),
                baseUrl: $creds->get('wordpress', 'url', 'https://yourdomain.com/wp-json'),
            );
        });
    }

    /**
     * Boot the service provider — register the ToolProvider with the registry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WordPressToolProvider());
        }
    }
}
