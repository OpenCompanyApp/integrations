<?php

namespace OpenCompany\Integrations\Semgrep;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Semgrep integration with Laravel's service container.
 *
 * Binds SemgrepService from host credentials and registers SemgrepToolProvider
 * with the shared provider registry when available.
 */
class SemgrepServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(SemgrepService::class, function($app): SemgrepService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new SemgrepService(apiToken:$creds?->get('semgrep','api_token','')??'', baseUrl:$creds?->get('semgrep','url','https://semgrep.dev')??'https://semgrep.dev'); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new SemgrepToolProvider); }
}