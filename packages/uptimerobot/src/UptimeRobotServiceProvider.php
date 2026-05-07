<?php

namespace OpenCompany\Integrations\UptimeRobot;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the UptimeRobot integration with Laravel's service container.
 *
 * Binds UptimeRobotService from host credentials and registers the tool provider
 * with the discovery registry when available.
 */
class UptimeRobotServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UptimeRobotService::class, function ($app): UptimeRobotService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new UptimeRobotService(
                apiKey: $creds?->get('uptimerobot', 'api_key', '') ?? '',
                baseUrl: $creds?->get('uptimerobot', 'url', 'https://api.uptimerobot.com/v3') ?? 'https://api.uptimerobot.com/v3',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new UptimeRobotToolProvider);
        }
    }
}
