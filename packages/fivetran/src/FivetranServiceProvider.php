<?php

namespace OpenCompany\Integrations\Fivetran;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Fivetran integration with Laravel's service container.
 *
 * Binds FivetranService from host credentials and registers FivetranToolProvider
 * with the shared provider registry when available.
 */
class FivetranServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(FivetranService::class, function($app): FivetranService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new FivetranService(apiKey:$creds?->get('fivetran','api_key','')??'', apiSecret:$creds?->get('fivetran','api_secret','')??'', baseUrl:$creds?->get('fivetran','url','https://api.fivetran.com')??'https://api.fivetran.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new FivetranToolProvider); }
}