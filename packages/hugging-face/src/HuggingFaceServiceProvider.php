<?php

namespace OpenCompany\Integrations\HuggingFace;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class HuggingFaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HuggingFaceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new HuggingFaceService(
                accessToken: $creds->get('hugging-face', 'access_token', ''),
                baseUrl: $creds->get('hugging-face', 'url', 'https://huggingface.co/api'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new HuggingFaceToolProvider());
        }
    }
}
