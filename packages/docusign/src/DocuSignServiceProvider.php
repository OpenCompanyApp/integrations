<?php

namespace OpenCompany\Integrations\DocuSign;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class DocuSignServiceProvider extends ServiceProvider
{
    /**
     * Register the DocuSign service singleton.
     */
    public function register(): void
    {
        $this->app->singleton(DocuSignService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new DocuSignService(
                accessToken: $creds->get('docusign', 'access_token', ''),
                accountId: $creds->get('docusign', 'account_id', ''),
                basePath: $creds->get('docusign', 'base_path', ''),
            );
        });
    }

    /**
     * Boot the DocuSign integration.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new DocuSignToolProvider());
        }
    }
}
