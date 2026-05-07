<?php

namespace OpenCompany\Integrations\MicrosoftPlanner;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Microsoft Planner integration with Laravel.
 *
 * Binds the Graph-backed Planner service and registers the tool provider with
 * the shared integration registry when available.
 */
class MicrosoftPlannerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MicrosoftPlannerService::class, function ($app): MicrosoftPlannerService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new MicrosoftPlannerService(
                accessToken: $creds?->get('microsoft-planner', 'access_token', '') ?? '',
                baseUrl: $creds?->get('microsoft-planner', 'base_url', 'https://graph.microsoft.com/v1.0') ?? 'https://graph.microsoft.com/v1.0',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new MicrosoftPlannerToolProvider);
        }
    }
}
