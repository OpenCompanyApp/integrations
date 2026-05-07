<?php

namespace OpenCompany\Integrations\Cloudsmith;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Cloudsmith integration with Laravel's service container.
 *
 * Binds CloudsmithService from host credentials and registers CloudsmithToolProvider
 * with the shared provider registry when available.
 */
class CloudsmithServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(CloudsmithService::class, function($app): CloudsmithService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new CloudsmithService(apiToken:$creds?->get('cloudsmith','api_token','')??'', baseUrl:$creds?->get('cloudsmith','url','https://api.cloudsmith.io')??'https://api.cloudsmith.io'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new CloudsmithToolProvider); }
}
