<?php

namespace OpenCompany\Integrations\MercadoPago;

use Illuminate\Support\ServiceProvider;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;

class MercadoPagoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(MercadoPagoService::class, function ($app) {
            $creds = $app->make(CredentialResolver::class);

            return new MercadoPagoService(
                accessToken: $creds->get('mercado-pago', 'access_token', ''),
                baseUrl: $creds->get('mercado-pago', 'url', 'https://api.mercadopago.com/v1'),
            );
        });
    }

    public function boot(): void
    {
        if ($this->app->bound(ToolProviderRegistry::class)) {
            $this->app->make(ToolProviderRegistry::class)
                ->register(new MercadoPagoToolProvider());
        }
    }
}
