<?php

namespace OpenCompany\Integrations\OpenSsfScorecard;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenSSF Scorecard integration with Laravel's service container.
 *
 * Binds the public Scorecard API client and registers the tool provider with
 * the shared ToolProviderRegistry during boot.
 */
class OpenSsfScorecardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OpenSsfScorecardService::class, fn (): OpenSsfScorecardService => new OpenSsfScorecardService);
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new OpenSsfScorecardToolProvider);
        }
    }
}
