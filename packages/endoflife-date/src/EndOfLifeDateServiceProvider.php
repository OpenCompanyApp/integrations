<?php

namespace OpenCompany\Integrations\EndOfLifeDate;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the endoflife.date integration with Laravel's service container.
 *
 * Binds the public API client and registers the tool provider with the shared
 * ToolProviderRegistry during boot.
 */
class EndOfLifeDateServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EndOfLifeDateService::class, fn (): EndOfLifeDateService => new EndOfLifeDateService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new EndOfLifeDateToolProvider);
        }
    }
}
