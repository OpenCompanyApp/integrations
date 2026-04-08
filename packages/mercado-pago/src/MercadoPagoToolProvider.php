<?php

namespace OpenCompany\Integrations\MercadoPago;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListPayments;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetPayment;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoCreatePayment;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListCustomers;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetCustomer;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListPreferences;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetCurrentUser;

class MercadoPagoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'mercado-pago';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'payments, customers, preferences',
            'description' => 'Latin American payments platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:mercadopago',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mercado Pago',
            'description' => 'Latin American payment processing and financial services',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:mercadopago',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://www.mercadopago.com.br/developers/en/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Mercado Pago access token',
                'hint' => 'Generate an access token in your Mercado Pago developer dashboard under "Credentials"',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.mercadopago.com/v1/users/me');

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'success' => true,
                    'message' => "Connected to Mercado Pago as {$data['first_name']} {$data['last_name']} (ID: {$data['id']}).",
                ];
            }

            return [
                'success' => false,
                'error' => "Mercado Pago API returned status {$response->status()}: {$response->body()}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'mercado_pago_list_payments' => [
                'class' => MercadoPagoListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'Search and list payments with filters.',
                'icon' => 'ph:list',
            ],
            'mercado_pago_get_payment' => [
                'class' => MercadoPagoGetPayment::class,
                'type' => 'read',
                'name' => 'Get Payment',
                'description' => 'Retrieve details of a specific payment.',
                'icon' => 'ph:credit-card',
            ],
            'mercado_pago_create_payment' => [
                'class' => MercadoPagoCreatePayment::class,
                'type' => 'write',
                'name' => 'Create Payment',
                'description' => 'Create a new payment charge.',
                'icon' => 'ph:plus-circle',
            ],
            'mercado_pago_list_customers' => [
                'class' => MercadoPagoListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'Search and list customers.',
                'icon' => 'ph:users',
            ],
            'mercado_pago_get_customer' => [
                'class' => MercadoPagoGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve details of a specific customer.',
                'icon' => 'ph:user',
            ],
            'mercado_pago_list_preferences' => [
                'class' => MercadoPagoListPreferences::class,
                'type' => 'read',
                'name' => 'List Preferences',
                'description' => 'List checkout preferences.',
                'icon' => 'ph:list-checks',
            ],
            'mercado_pago_get_current_user' => [
                'class' => MercadoPagoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mercado-pago.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MercadoPagoService(
                accessToken: $creds->get('mercado-pago', 'access_token', '', $account),
                baseUrl: $creds->get('mercado-pago', 'url', 'https://api.mercadopago.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(MercadoPagoService::class));
    }
}
