<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class SupabaseServiceProvider extends ServiceProvider
{
    /**
     * Register the Supabase service as a singleton.
     */
    public function register(): void
    {
        $this->app->singleton(SupabaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SupabaseService(
                accessToken: $creds->get('supabase', 'access_token', ''),
                baseUrl: $creds->get('supabase', 'url', 'https://api.supabase.com/v1'),
            );
        });
    }

    /**
     * Boot the service provider and register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SupabaseToolProvider());
        }
    }
}
