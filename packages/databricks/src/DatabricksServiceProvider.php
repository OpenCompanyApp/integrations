<?php

namespace OpenCompany\Integrations\Databricks;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Databricks integration with Laravel's service container.
 *
 * Binds DatabricksService from host credentials and registers DatabricksToolProvider
 * with the shared provider registry when available.
 */
class DatabricksServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(DatabricksService::class, function($app): DatabricksService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new DatabricksService(apiToken:$creds?->get('databricks','api_token','')??'', baseUrl:$creds?->get('databricks','url','')??'', accountId:$creds?->get('databricks','account_id','')??'', workspaceId:$creds?->get('databricks','workspace_id','')??''); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new DatabricksToolProvider); }
}