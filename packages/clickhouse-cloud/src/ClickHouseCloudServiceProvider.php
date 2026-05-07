<?php

namespace OpenCompany\Integrations\ClickHouseCloud;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the ClickHouse Cloud integration with Laravel's service container.
 *
 * Binds ClickHouseCloudService from host credentials and registers
 * ClickHouseCloudToolProvider with the shared provider registry when available.
 */
class ClickHouseCloudServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(ClickHouseCloudService::class, function($app): ClickHouseCloudService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new ClickHouseCloudService(keyId:$creds?->get('clickhouse-cloud','key_id','')??'', keySecret:$creds?->get('clickhouse-cloud','key_secret','')??'', baseUrl:$creds?->get('clickhouse-cloud','url','https://api.clickhouse.cloud')??'https://api.clickhouse.cloud'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new ClickHouseCloudToolProvider); }
}