<?php

namespace OpenCompany\Integrations\Pulumi;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Pulumi integration with Laravel's service container.
 *
 * Binds PulumiService from host credentials and registers PulumiToolProvider
 * with the shared provider registry when available.
 */
class PulumiServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(PulumiService::class, function($app): PulumiService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new PulumiService(apiToken:$creds?->get('pulumi','api_token','')??'', baseUrl:$creds?->get('pulumi','url','https://api.pulumi.com')??'https://api.pulumi.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new PulumiToolProvider); }
}