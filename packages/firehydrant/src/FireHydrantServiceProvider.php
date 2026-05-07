<?php

namespace OpenCompany\Integrations\FireHydrant;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the FireHydrant integration with Laravel's service container.
 *
 * Binds FireHydrantService from host credentials and registers FireHydrantToolProvider
 * with the shared provider registry when available.
 */
class FireHydrantServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(FireHydrantService::class, function($app): FireHydrantService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new FireHydrantService(apiToken:$creds?->get('firehydrant','api_token','')??'', baseUrl:$creds?->get('firehydrant','url','https://api.firehydrant.io')??'https://api.firehydrant.io'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new FireHydrantToolProvider); }
}