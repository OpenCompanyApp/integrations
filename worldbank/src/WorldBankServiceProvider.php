<?php

namespace OpenCompany\Integrations\WorldBank;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class WorldBankServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(WorldBankService::class);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WorldBankToolProvider());
        }
    }
}
