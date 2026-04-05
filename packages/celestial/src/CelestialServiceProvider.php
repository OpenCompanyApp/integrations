<?php

namespace OpenCompany\Integrations\Celestial;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class CelestialServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CelestialService::class);
    }

    public function boot(): void
    {
        // Register with the core tool registry if it's available
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new CelestialToolProvider());
        }
    }
}
