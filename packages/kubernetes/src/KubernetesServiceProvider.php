<?php

namespace OpenCompany\Integrations\Kubernetes;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Kubernetes integration with Laravel's service container.
 *
 * Binds KubernetesService from host credentials and registers KubernetesToolProvider
 * with the shared provider registry when available.
 */
class KubernetesServiceProvider extends ServiceProvider
{
    public function register(): void { $this->app->singleton(KubernetesService::class, function($app): KubernetesService { $creds=$app->bound(CredentialResolver::class)?$app->make(CredentialResolver::class):null; return new KubernetesService(apiToken:$creds?->get('kubernetes','api_token','')??'', baseUrl:$creds?->get('kubernetes','url','')??''); }); }
    public function boot(): void { if($this->app->bound(ToolProviderRegistry::class)) $this->app->make(ToolProviderRegistry::class)->register(new KubernetesToolProvider); }
}