<?php

namespace OpenCompany\Integrations\FreshworksCrm;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Freshworks CRM integration with Laravel.
 *
 * Binds the FreshworksCrmService using configured credentials and registers
 * the provider with the ToolProviderRegistry when available.
 */
class FreshworksCrmServiceProvider extends ServiceProvider
{
    /**
     * Register the Freshworks CRM API service.
     */
    public function register(): void
    {
        $this->app->singleton(FreshworksCrmService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('freshworks-crm', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('freshworks_crm', $key, $default);
            };

            $domain = $get('domain');
            $baseUrl = $domain
                ? "https://{$domain}.myfreshworks.com/crm/sales"
                : $get('base_url');

            return new FreshworksCrmService(
                apiKey: $get('api_key'),
                baseUrl: $baseUrl,
            );
        });
    }

    /**
     * Boot the provider and register Freshworks CRM tools.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshworksCrmToolProvider());
        }
    }
}
