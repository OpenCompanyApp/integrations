<?php

namespace OpenCompany\Integrations\VegaLite;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class VegaLiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VegaLiteService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new VegaLiteToolProvider());
        }
    }
}
