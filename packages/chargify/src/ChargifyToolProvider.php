<?php

namespace OpenCompany\Integrations\Chargify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetCustomer;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetCurrentUser;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetInvoice;
use OpenCompany\Integrations\Chargify\Tools\ChargifyGetSubscription;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListCustomers;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListInvoices;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListProducts;
use OpenCompany\Integrations\Chargify\Tools\ChargifyListSubscriptions;

/**
 * Registers the Chargify / Maxio Advanced Billing integration provider.
 */
class ChargifyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'basic_auth_api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'api_key',
            ],
            'notes' =>
            [
              0 => 'Maxio Advanced Billing uses HTTP Basic Auth. The API key is the username; most legacy sites use x as the password.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'chargify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Chargify',
            'description' => 'Billing & subscription management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Chargify',
            'description' => 'Recurring billing and subscription management platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargify',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.maxio.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Chargify API key',
                'hint' => 'Find your API key in Chargify under Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'api_password',
                'type' => 'secret',
                'label' => 'API Password',
                'placeholder' => 'x',
                'hint' => 'Optional Basic Auth password. Legacy Advanced Billing API keys usually use x.',
                'required' => false,
                'default' => 'x',
            ],
            [
                'key' => 'subdomain',
                'type' => 'string',
                'label' => 'Subdomain',
                'placeholder' => 'your-subdomain',
                'hint' => 'Your Chargify subdomain (used as <code>{subdomain}.chargify.com</code>). Only needed if not providing a custom URL.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://your-subdomain.chargify.com',
                'hint' => 'Override the default base URL. If empty, the subdomain is used to construct <code>https://{subdomain}.chargify.com</code>.',
                'default' => '',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $apiPassword = $config['api_password'] ?? 'x';
        $subdomain = $config['subdomain'] ?? '';
        $baseUrl = isset($config['url']) && $config['url'] !== ''
            ? rtrim($config['url'], '/')
            : 'https://' . $subdomain . '.chargify.com';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($subdomain) && empty($config['url'])) {
            return ['success' => false, 'error' => 'No subdomain or base URL provided'];
        }

        try {
            $response = Http::acceptJson()
                ->withBasicAuth($apiKey, $apiPassword !== '' ? $apiPassword : 'x')
                ->timeout(10)
                ->get($baseUrl . '/site.json');

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid API key.'];
            }

            if ($response->status() === 404) {
                return ['success' => false, 'error' => "Subdomain not found at {$baseUrl}."];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Chargify API returned HTTP {$response->status()}.",
                ];
            }

            $data = $response->json();
            $siteName = $data['site']['name'] ?? $data['site']['subdomain'] ?? $subdomain ?: 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Chargify site {$siteName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'api_password' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'chargify_list_subscriptions' => [
                'class' => ChargifyListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Subscriptions',
                'description' => 'List subscriptions with optional state filtering and pagination.',
                'icon' => 'ph:arrows-repeat',
            ],
            'chargify_get_subscription' => [
                'class' => ChargifyGetSubscription::class,
                'type' => 'read',
                'name' => 'Get Subscription',
                'description' => 'Get details for a single subscription.',
                'icon' => 'ph:arrows-repeat',
            ],
            'chargify_list_customers' => [
                'class' => ChargifyListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers with pagination.',
                'icon' => 'ph:users',
            ],
            'chargify_get_customer' => [
                'class' => ChargifyGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details for a single customer.',
                'icon' => 'ph:user',
            ],
            'chargify_list_products' => [
                'class' => ChargifyListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List available products.',
                'icon' => 'ph:package',
            ],
            'chargify_list_invoices' => [
                'class' => ChargifyListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional status filtering.',
                'icon' => 'ph:invoice',
            ],
            'chargify_get_invoice' => [
                'class' => ChargifyGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get details for a single invoice.',
                'icon' => 'ph:receipt',
            ],
            'chargify_get_current_user' => [
                'class' => ChargifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Read the current Advanced Billing site as a lightweight API check.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/chargify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_password', 'type' => 'secret', 'label' => 'API Password', 'required' => false, 'default' => 'x'],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => ''],
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
            $creds = app(CredentialResolver::class);

            $service = new ChargifyService(
                apiKey: $creds->get('chargify', 'api_key', '', $account),
                subdomain: $creds->get('chargify', 'subdomain', '', $account),
                baseUrl: $creds->get('chargify', 'url', '', $account),
                apiPassword: $creds->get('chargify', 'api_password', 'x', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargifyService::class));
    }
}
