<?php

namespace OpenCompany\Integrations\Rootly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Rootly integration with Laravel's service container.
 *
 * Binds RootlyService from host credentials and registers RootlyToolProvider
 * with the shared provider registry when available.
 */
class RootlyServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(RootlyService::class, function($app): RootlyService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new RootlyService(apiToken:$creds?->get('rootly','api_token','')??'', baseUrl:$creds?->get('rootly','url','https://api.rootly.com')??'https://api.rootly.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new RootlyToolProvider); }
}