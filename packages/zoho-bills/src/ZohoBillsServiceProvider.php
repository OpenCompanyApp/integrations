<?php

namespace OpenCompany\Integrations\ZohoBills;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class ZohoBillsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ZohoBillsService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $get = static function (string $key, mixed $default = '') use ($creds): mixed {
                $value = $creds->get('zoho-bills', $key, null);

                return $value !== null && $value !== ''
                    ? $value
                    : $creds->get('zoho_bills', $key, $default);
            };

            return new ZohoBillsService(
                accessToken: $get('access_token'),
                organizationId: $get('organization_id'),
                baseUrl: $get('url', 'https://billing.zoho.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new ZohoBillsToolProvider());
        }
    }
}
