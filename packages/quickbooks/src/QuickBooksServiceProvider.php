<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class QuickBooksServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(QuickBooksService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new QuickBooksService(
                accessToken: $creds->get('quickbooks', 'access_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new QuickBooksToolProvider());
        }
    }
}
