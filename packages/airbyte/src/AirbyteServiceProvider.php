<?php

namespace OpenCompany\Integrations\Airbyte;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Airbyte integration with Laravel's service container.
 *
 * Binds AirbyteService from host credentials and registers AirbyteToolProvider
 * with the shared provider registry when available.
 */
class AirbyteServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(AirbyteService::class, function($app): AirbyteService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new AirbyteService(accessToken:$creds?->get('airbyte','access_token','')??'', baseUrl:$creds?->get('airbyte','url','https://api.airbyte.com/v1')??'https://api.airbyte.com/v1'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new AirbyteToolProvider); }
}