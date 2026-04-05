<?php

namespace OpenCompany\Integrations\Supabase;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the Supabase integration.
 *
 * Registers the SupabaseService singleton and bootstraps the Supabase tool provider.
 */
class SupabaseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SupabaseService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new SupabaseService(
                apiKey: $creds->get('supabase', 'api_key', ''),
                projectUrl: $creds->get('supabase', 'project_url', ''),
                bearerToken: $creds->get('supabase', 'bearer_token', ''),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new SupabaseToolProvider());
        }
    }
}
