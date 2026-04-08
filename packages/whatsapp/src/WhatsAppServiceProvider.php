<?php

namespace OpenCompany\Integrations\WhatsApp;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

/**
 * Laravel service provider for the WhatsApp Business API integration.
 *
 * Registers the {@see WhatsAppService} singleton and bootstraps the
 * {@see WhatsAppToolProvider} into the tool-registry when available.
 */
class WhatsAppServiceProvider extends ServiceProvider
{
    /**
     * Register the WhatsApp service into the container.
     */
    public function register(): void
    {
        $this->app->singleton(WhatsAppService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new WhatsAppService(
                accessToken: $creds->get('whatsapp', 'access_token', ''),
                phoneNumberId: $creds->get('whatsapp', 'phone_number_id', ''),
                baseUrl: $creds->get('whatsapp', 'base_url', 'https://graph.facebook.com/v21.0'),
            );
        });
    }

    /**
     * Boot the service provider — register the tool provider.
     */
    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new WhatsAppToolProvider());
        }
    }
}
