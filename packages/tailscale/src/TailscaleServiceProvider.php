<?php

namespace OpenCompany\Integrations\Tailscale;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Tailscale integration with Laravel's service container.
 *
 * Binds TailscaleService from host credentials and registers TailscaleToolProvider
 * with the shared provider registry when available.
 */
class TailscaleServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(TailscaleService::class, function($app): TailscaleService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new TailscaleService(apiToken:$creds?->get('tailscale','api_token','')??'', baseUrl:$creds?->get('tailscale','url','https://api.tailscale.com/api/v2')??'https://api.tailscale.com/api/v2'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new TailscaleToolProvider); }
}