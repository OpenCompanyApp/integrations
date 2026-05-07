<?php

namespace OpenCompany\Integrations\HuggingFace;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Registers the Hugging Face integration with Laravel's service container.
 *
 * Binds the Hub and Inference API client and registers the tool provider when
 * the host exposes the shared ToolProviderRegistry.
 */
class HuggingFaceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HuggingFaceService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);
            $accessToken = $creds->get('hugging-face', 'access_token', '')
                ?: $creds->get('huggingface', 'access_token', '');
            $baseUrl = $creds->get('hugging-face', 'url', '')
                ?: $creds->get('huggingface', 'url', 'https://huggingface.co/api');
            $inferenceUrl = $creds->get('hugging-face', 'inference_url', '')
                ?: $creds->get('huggingface', 'inference_url', 'https://router.huggingface.co/hf-inference/models');

            return new HuggingFaceService(
                accessToken: $accessToken,
                baseUrl: $baseUrl,
                inferenceUrl: $inferenceUrl,
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
