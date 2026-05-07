<?php

namespace OpenCompany\Integrations\Snyk;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Snyk integration with Laravel's service container.
 *
 * Binds SnykService from host credentials and registers SnykToolProvider with
 * the shared provider registry when available.
 */
class SnykServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(SnykService::class, function($app): SnykService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new SnykService(apiToken:$creds?->get('snyk','api_token','')??'', baseUrl:$creds?->get('snyk','url','https://api.snyk.io/rest')??'https://api.snyk.io/rest', apiVersion:$creds?->get('snyk','version','2024-10-15')??'2024-10-15'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new SnykToolProvider); }
}