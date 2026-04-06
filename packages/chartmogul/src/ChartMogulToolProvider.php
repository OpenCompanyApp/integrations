<?php

namespace OpenCompany\Integrations\ChartMogul;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListCustomers;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetCustomer;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListSubscriptions;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListPlans;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulListInvoices;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetMetrics;
use OpenCompany\Integrations\ChartMogul\Tools\ChartMogulGetCurrentUser;

class ChartMogulToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'chartmogul';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'customers, subscriptions, plans, invoices, metrics',
            'description' => 'Subscription analytics',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:chartmogul',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ChartMogul',
            'description' => 'Subscription analytics and revenue intelligence platform',
            'icon' => 'ph:chart-bar',
            'logo' => 'simple-icons:chartmogul',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://dev.chartmogul.com/docs/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your ChartMogul API key',
                'hint' => 'Generate an API key in your ChartMogul account under <strong>Config → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.chartmogul.com',
                'hint' => 'Use <code>https://api.chartmogul.com</code> for the default endpoint',
                'default' => 'https://api.chartmogul.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.chartmogul.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach ChartMogul API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "ChartMogul API error: {$error}",
                ];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to ChartMogul API as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'chartmogul_list_customers' => [
                'class' => ChartMogulListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers with filtering and pagination.',
                'icon' => 'ph:users',
            ],
            'chartmogul_get_customer' => [
                'class' => ChartMogulGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details for a single customer.',
                'icon' => 'ph:user',
            ],
            'chartmogul_list_subscriptions' => [
                'class' => ChartMogulListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions with filtering and pagination.',
                'icon' => 'ph:repeat',
            ],
            'chartmogul_list_plans' => [
                'class' => ChartMogulListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List billing plans.',
                'icon' => 'ph:list-bullets',
            ],
            'chartmogul_list_invoices' => [
                'class' => ChartMogulListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with filtering and pagination.',
                'icon' => 'ph:receipt',
            ],
            'chartmogul_get_metrics' => [
                'class' => ChartMogulGetMetrics::class,
                'type' => 'read',
                'name' => 'Get Metrics',
                'description' => 'Query subscription analytics metrics (MRR, churn, etc.).',
                'icon' => 'ph:chart-line-up',
            ],
            'chartmogul_get_current_user' => [
                'class' => ChartMogulGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated ChartMogul user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/chartmogul.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.chartmogul.com'],
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

            $service = new ChartMogulService(
                apiKey: $creds->get('chartmogul', 'api_key', '', $account),
                baseUrl: $creds->get('chartmogul', 'url', 'https://api.chartmogul.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChartMogulService::class));
    }
}
