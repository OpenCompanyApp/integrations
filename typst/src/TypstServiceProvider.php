<?php

namespace OpenCompany\Integrations\Typst;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class TypstServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TypstService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new TypstToolProvider());
        }
    }
}
