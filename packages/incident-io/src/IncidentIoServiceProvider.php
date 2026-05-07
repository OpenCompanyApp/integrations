<?php

namespace OpenCompany\Integrations\IncidentIo;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the incident.io integration with Laravel's service container.
 *
 * Binds IncidentIoService from host credentials and registers IncidentIoToolProvider
 * with the shared provider registry when available.
 */
class IncidentIoServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(IncidentIoService::class, function($app): IncidentIoService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new IncidentIoService(apiKey:$creds?->get('incident-io','api_key','')??'', baseUrl:$creds?->get('incident-io','url','https://api.incident.io')??'https://api.incident.io'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new IncidentIoToolProvider); }
}