<?php

namespace OpenCompany\Integrations\OnePasswordConnect;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the 1Password Connect integration with Laravel's service container.
 *
 * Binds OnePasswordConnectService from host credentials and registers
 * OnePasswordConnectToolProvider with the shared provider registry when available.
 */
class OnePasswordConnectServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(OnePasswordConnectService::class, function($app): OnePasswordConnectService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new OnePasswordConnectService(apiToken:$creds?->get('onepassword-connect','api_token','')??'', baseUrl:$creds?->get('onepassword-connect','url','http://localhost:8080/v1')??'http://localhost:8080/v1'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new OnePasswordConnectToolProvider); }
}
