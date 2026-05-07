<?php

namespace OpenCompany\Integrations\Temporal;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Temporal integration with Laravel's service container.
 *
 * Binds TemporalService from host credentials and registers TemporalToolProvider
 * with the shared provider registry when available.
 */
class TemporalServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(TemporalService::class, function($app): TemporalService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new TemporalService(apiToken:$creds?->get('temporal','api_token','')??'', baseUrl:$creds?->get('temporal','url','')??''); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new TemporalToolProvider); }
}
