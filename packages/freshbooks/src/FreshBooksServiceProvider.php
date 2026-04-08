<?php

namespace OpenCompany\Integrations\FreshBooks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class FreshBooksServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(FreshBooksService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new FreshBooksService(
                accessToken: $creds->get('freshbooks', 'access_token', ''),
                accountId: $creds->get('freshbooks', 'account_id', ''),
                baseUrl: $creds->get('freshbooks', 'url', 'https://api.freshbooks.com'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new FreshBooksToolProvider());
        }
    }
}
