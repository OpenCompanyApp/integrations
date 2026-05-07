<?php

namespace OpenCompany\Integrations\Miro;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Miro integration with Laravel's service container.
 *
 * Binds MiroService from host credentials and registers MiroToolProvider with
 * the shared provider registry when available.
 */
class MiroServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(MiroService::class, function($app): MiroService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new MiroService(accessToken:$creds?->get('miro','access_token','')??'', baseUrl:$creds?->get('miro','url','https://api.miro.com')??'https://api.miro.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new MiroToolProvider); }
}
