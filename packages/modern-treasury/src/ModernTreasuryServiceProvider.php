<?php

namespace OpenCompany\Integrations\ModernTreasury;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Modern Treasury integration with Laravel's service container.
 *
 * Binds ModernTreasuryService from host credentials and registers the provider
 * with the shared ToolProviderRegistry when available.
 */
class ModernTreasuryServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(ModernTreasuryService::class, function($app): ModernTreasuryService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new ModernTreasuryService(organizationId:($creds?->get('modern-treasury','organization_id','') ?: $creds?->get('modern_treasury','organization_id',''))??'', apiKey:($creds?->get('modern-treasury','api_key','') ?: $creds?->get('modern_treasury','api_key',''))??'', baseUrl:($creds?->get('modern-treasury','url','') ?: $creds?->get('modern_treasury','url','https://app.moderntreasury.com'))??'https://app.moderntreasury.com'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new ModernTreasuryToolProvider); }
}
