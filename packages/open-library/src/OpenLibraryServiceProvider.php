<?php

namespace OpenCompany\Integrations\OpenLibrary;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Open Library integration with Laravel's service container.
 *
 * Binds the public API client and registers the tool provider with the shared
 * ToolProviderRegistry during boot.
 */
class OpenLibraryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenLibraryService::class, fn (): OpenLibraryService => new OpenLibraryService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenLibraryToolProvider);
        }
    }
}
