<?php

namespace OpenCompany\Integrations\Ramp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Ramp integration with Laravel's service container.
 *
 * Binds RampService from host credentials and registers RampToolProvider with
 * the shared provider registry when available.
 */
class RampServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(RampService::class, function($app): RampService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new RampService(accessToken:$creds?->get('ramp','access_token','')??'', baseUrl:$creds?->get('ramp','url','https://api.ramp.com')??'https://api.ramp.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new RampToolProvider); }
}