<?php

namespace OpenCompany\Integrations\PlantUml;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class PlantUmlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(PlantUmlService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new PlantUmlToolProvider());
        }
    }
}
