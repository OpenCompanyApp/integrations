<?php

namespace OpenCompany\Integrations\ZohoBooks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Zoho Books integration.
 *
 * Registers the ZohoBooksService as a singleton and bootstraps
 * the tool provider with the ToolProviderRegistry.
 */
class ZohoBooksServiceProvider extends ServiceProvider
{
    /**
     * Register the ZohoBooksService singleton.
     */
    public function register(): void
    {
        $this->app->singleton(ZohoBooksService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('zoho-books', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_books', $key, $default);
            };

            return new ZohoBooksService(
                accessToken: $get('access_token'),
                organizationId: $get('organization_id'),
                baseUrl: $get('url', 'https://www.zohoapis.com/books/v3'),
            );
        });
    }

    /**
     * Boot the service provider — register tools with the ToolProviderRegistry.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoBooksToolProvider());
        }
    }
}
