<?php

namespace OpenCompany\Integrations\Mermaid;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MermaidServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MermaidService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MermaidToolProvider());
        }
    }
}
