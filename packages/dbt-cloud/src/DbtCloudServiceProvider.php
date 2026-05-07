<?php

namespace OpenCompany\Integrations\DbtCloud;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the dbt Cloud integration with Laravel's service container.
 *
 * Binds DbtCloudService from host credentials and registers DbtCloudToolProvider
 * with the shared provider registry when available.
 */
class DbtCloudServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(DbtCloudService::class, function($app): DbtCloudService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new DbtCloudService(accessToken:$creds?->get('dbt-cloud','access_token','')??'', baseUrl:$creds?->get('dbt-cloud','url','https://cloud.getdbt.com')??'https://cloud.getdbt.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new DbtCloudToolProvider); }
}