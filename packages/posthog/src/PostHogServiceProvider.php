<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the PostHog integration with Laravel's service container.
 *
 * Binds PostHogService with configured credentials and registers the generated
 * PostHogToolProvider with the ToolProviderRegistry on boot.
 */
class PostHogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PostHogService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new PostHogService(apiToken: (string) $creds->get('posthog', 'api_token', ''), baseUrl: (string) $creds->get('posthog', 'url', 'https://us.posthog.com'), projectId: (string) $creds->get('posthog', 'project_id', ''), environmentId: (string) $creds->get('posthog', 'environment_id', ''), projectApiKey: (string) $creds->get('posthog', 'project_api_key', ''));
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new PostHogToolProvider());
    }
}
