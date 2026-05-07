<?php

namespace OpenCompany\Integrations\WpEngine;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the WP Engine integration with Laravel.
 *
 * Binds the API service from host credentials and registers the tool provider
 * with the shared registry when the host exposes one.
 */
class WpEngineServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WpEngineService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('wp-engine', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('wp_engine', $key, $default);
            };

            return new WpEngineService(
                accessToken: $get('access_token'),
                baseUrl: $get('url', 'https://api.wpengineapi.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WpEngineToolProvider());
        }
    }
}
