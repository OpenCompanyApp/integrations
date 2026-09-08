<?php

namespace OpenCompany\Integrations\ChargeOver;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCustomer;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetCurrentUser;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetInvoice;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverGetTransaction;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListCustomers;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListInvoices;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListSubscriptions;
use OpenCompany\Integrations\ChargeOver\Tools\ChargeOverListTransactions;

/**
 * Registers the ChargeOver integration provider and exposes billing tools.
 */
class ChargeOverToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'basic_auth',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'stored_secret_pair',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'api_username',
              1 => 'api_password',
            ],
            'notes' =>
            [
              0 => 'ChargeOver REST API v3 uses HTTP Basic Auth with an API username/key and API password/secret.',
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'chargeover';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'ChargeOver',
            'description' => 'Billing & subscription management',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargeover',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'ChargeOver',
            'description' => 'Recurring billing and subscription management platform',
            'icon' => 'ph:credit-card',
            'logo' => 'simple-icons:chargeover',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.chargeover.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_username',
                'type' => 'string',
                'label' => 'API Username',
                'placeholder' => 'Enter your ChargeOver API username or key',
                'hint' => 'Create API credentials in ChargeOver, then use the API username/key as the Basic Auth username.',
                'required' => true,
            ],
            [
                'key' => 'api_password',
                'type' => 'secret',
                'label' => 'API Password',
                'placeholder' => 'Enter your ChargeOver API password or secret',
                'hint' => 'Use the matching API password/secret as the Basic Auth password.',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'string',
                'label' => 'Subdomain',
                'placeholder' => 'mycompany',
                'hint' => 'Your ChargeOver subdomain (e.g., <code>mycompany</code> for <code>mycompany.chargeover.com</code>)',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Custom URL',
                'placeholder' => 'https://mycompany.chargeover.com',
                'hint' => 'Override the base URL if using a custom domain or self-hosted instance. Takes priority over subdomain.',
                'default' => '',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiUsername = $config['api_username'] ?? $config['access_token'] ?? '';
        $apiPassword = $config['api_password'] ?? '';
        $subdomain = $config['subdomain'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($baseUrl) && !empty($subdomain)) {
            $baseUrl = 'https://' . $subdomain . '.chargeover.com';
        }

        $baseUrl = preg_replace('#/api/v3/?$#', '', $baseUrl) ?? '';

        if (empty($apiUsername) || empty($apiPassword)) {
            return ['success' => false, 'error' => 'No API username or password provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No subdomain or custom URL provided'];
        }

        try {
            $response = Http::acceptJson()
                ->withBasicAuth($apiUsername, $apiPassword)
                ->timeout(10)
                ->get($baseUrl . '/api/v3/customer', ['limit' => 1, 'offset' => 0]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to ChargeOver API at {$baseUrl}.",
                ];
            }

            return [
                'success' => false,
                'error' => "ChargeOver API returned HTTP {$response->status()}: " . ($response->json('message') ?? $response->body()),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_username' => 'nullable|string',
            'api_password' => 'nullable|string',
            'access_token' => 'nullable|string',
            'subdomain' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'chargeover_list_customers' => [
                'class' => ChargeOverListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers from ChargeOver.',
                'icon' => 'ph:users',
            ],
            'chargeover_get_customer' => [
                'class' => ChargeOverGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details for a specific customer.',
                'icon' => 'ph:user',
            ],
            'chargeover_list_subscriptions' => [
                'class' => ChargeOverListSubscriptions::class,
                'type' => 'read',
                'name' => 'List Packages',
                'description' => 'List packages/subscriptions from ChargeOver.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'chargeover_list_invoices' => [
                'class' => ChargeOverListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from ChargeOver.',
                'icon' => 'ph:file-text',
            ],
            'chargeover_get_invoice' => [
                'class' => ChargeOverGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get details for a specific invoice.',
                'icon' => 'ph:file',
            ],
            'chargeover_list_transactions' => [
                'class' => ChargeOverListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List transactions (payments) from ChargeOver.',
                'icon' => 'ph:money',
            ],
            'chargeover_get_transaction' => [
                'class' => ChargeOverGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Get details for a specific ChargeOver transaction.',
                'icon' => 'ph:receipt',
            ],
            'chargeover_get_current_user' => [
                'class' => ChargeOverGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Test API Access',
                'description' => 'Verify API access with a lightweight customer list request.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/chargeover.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_username', 'type' => 'string', 'label' => 'API Username', 'required' => true],
            ['key' => 'api_password', 'type' => 'secret', 'label' => 'API Password', 'required' => true],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'Custom URL', 'required' => false, 'default' => ''],
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

            $service = new ChargeOverService(
                apiUsername: $creds->get('chargeover', 'api_username', $creds->get('chargeover', 'access_token', '', $account), $account),
                apiPassword: $creds->get('chargeover', 'api_password', '', $account),
                subdomain: $creds->get('chargeover', 'subdomain', '', $account),
                baseUrl: $creds->get('chargeover', 'url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ChargeOverService::class));
    }
}
