<?php

namespace OpenCompany\Integrations\Checkly;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Checkly integration with Laravel's service container.
 *
 * Binds ChecklyService from host credentials and registers ChecklyToolProvider
 * with the shared provider registry when available.
 */
class ChecklyServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(ChecklyService::class, function($app): ChecklyService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new ChecklyService(apiKey:$creds?->get('checkly','api_key','')??'', accountId:$creds?->get('checkly','account_id','')??'', baseUrl:$creds?->get('checkly','url','https://api.checklyhq.com')??'https://api.checklyhq.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new ChecklyToolProvider); }
}
