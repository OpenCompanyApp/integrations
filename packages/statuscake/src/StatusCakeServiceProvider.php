<?php

namespace OpenCompany\Integrations\StatusCake;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the StatusCake integration with Laravel's service container.
 *
 * Binds StatusCakeService from host credentials and registers StatusCakeToolProvider
 * with the shared provider registry when available.
 */
class StatusCakeServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(StatusCakeService::class, function($app): StatusCakeService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new StatusCakeService(apiKey:$creds?->get('statuscake','api_key','')??'', baseUrl:$creds?->get('statuscake','url','https://api.statuscake.com/v1')??'https://api.statuscake.com/v1'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new StatusCakeToolProvider); }
}
