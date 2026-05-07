<?php

namespace OpenCompany\Integrations\OpenFGA;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the OpenFGA integration with Laravel's service container.
 *
 * Binds OpenFGAService from host credentials and registers OpenFGAToolProvider
 * with the shared provider registry when available.
 */
class OpenFGAServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(OpenFGAService::class, function($app): OpenFGAService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new OpenFGAService(apiToken:$creds?->get('openfga','api_token','')??'', baseUrl:$creds?->get('openfga','url','http://localhost:8080')??'http://localhost:8080'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new OpenFGAToolProvider); }
}
