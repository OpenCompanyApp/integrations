<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\ServiceProvider;
use OpenCompany\Integrations\Core\Contracts\CredentialResolver;
use OpenCompany\Integrations\Core\Support\ToolProviderRegistry;

class VercelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(VercelService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            return new VercelService(token: $creds->get('vercel', 'token', ''));
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)->register(new VercelToolProvider());
        }
    }
}
