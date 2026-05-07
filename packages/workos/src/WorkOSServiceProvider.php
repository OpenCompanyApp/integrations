<?php

namespace OpenCompany\Integrations\WorkOS;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the WorkOS integration with Laravel's service container.
 *
 * Binds WorkOSService from host credentials and registers WorkOSToolProvider with
 * the shared provider registry when available.
 */
class WorkOSServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(WorkOSService::class, function($app): WorkOSService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new WorkOSService(apiKey:$creds?->get('workos','api_key','')??'', baseUrl:$creds?->get('workos','url','https://api.workos.com')??'https://api.workos.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new WorkOSToolProvider); }
}