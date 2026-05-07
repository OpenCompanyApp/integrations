<?php

namespace OpenCompany\Integrations\Shortcut;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Shortcut integration with Laravel's service container.
 *
 * Binds the Shortcut API client from configured credentials and registers the
 * provider for discovery when the host registry is available.
 */
class ShortcutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ShortcutService::class, function ($app): ShortcutService {
            $creds = $app->bound(CredentialResolver::class) ? $app->make(CredentialResolver::class) : null;

            return new ShortcutService(
                apiKey: $creds?->get('shortcut', 'api_key', '') ?? '',
                baseUrl: $creds?->get('shortcut', 'url', 'https://api.app.shortcut.com') ?? 'https://api.app.shortcut.com',
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new ShortcutToolProvider);
        }
    }
}
