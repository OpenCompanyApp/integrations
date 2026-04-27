<?php

namespace OpenCompany\Integrations\Taxjar;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarListOrders;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarGetOrder;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarListRefunds;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarListTransactions;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarGetTransaction;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarListCategories;
use OpenCompany\Integrations\Taxjar\Tools\TaxjarGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class TaxjarToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
            ],
            'notes' =>
            [
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




/**
     * {@inheritdoc}
     */
    public function appName(): string
    {
        return 'taxjar';
    }

/**
     * {@inheritdoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'sales tax, orders, categories',
            'description' => 'Sales tax calculation & reporting',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:taxjar',
        ];
    }

/**
     * {@inheritdoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'TaxJar',
            'description' => 'Sales tax calculation, collection, and reporting',
            'icon' => 'ph:receipt',
            'logo' => 'simple-icons:taxjar',
            'category' => 'sales',
            'badge' => 'verified',
            'docs_url' => 'https://developers.taxjar.com/api/reference/',
        ];
    }/**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your TaxJar API access token',
                'hint' => 'Find your API token in TaxJar under Account > API Access',
                'required' => true,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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
            ])->timeout(10)->get('https://api.taxjar.com/v2/users/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to TaxJar successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "Authentication failed (HTTP {$response->status()}). Check your access token.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function tools(): array
    {
        return [
            'taxjar_list_orders' => [
                'class' => TaxjarListOrders::class,
                'type' => 'read',
                'name' => 'List Orders',
                'description' => 'List order transactions with optional date filtering and pagination.',
                'icon' => 'ph:list',
            ],
            'taxjar_get_order' => [
                'class' => TaxjarGetOrder::class,
                'type' => 'read',
                'name' => 'Get Order',
                'description' => 'Retrieve details of a single order transaction.',
                'icon' => 'ph:eye',
            ],
            'taxjar_list_refunds' => [
                'class' => TaxjarListRefunds::class,
                'type' => 'read',
                'name' => 'List Refunds',
                'description' => 'List refund transactions with optional date filtering and pagination.',
                'icon' => 'ph:arrow-counter-clockwise',
            ],
            'taxjar_list_transactions' => [
                'class' => TaxjarListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List all transactions (orders and refunds) with optional filtering.',
                'icon' => 'ph:arrows-left-right',
            ],
            'taxjar_get_transaction' => [
                'class' => TaxjarGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Retrieve details of a single transaction by ID.',
                'icon' => 'ph:file-text',
            ],
            'taxjar_list_categories' => [
                'class' => TaxjarListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List all tax categories available in TaxJar.',
                'icon' => 'ph:tag',
            ],
            'taxjar_get_current_user' => [
                'class' => TaxjarGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the current authenticated user information.',
                'icon' => 'ph:info',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/taxjar.md';
    }

    /**
     * {@inheritdoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolved for a specific account.
     *
     * When an account context is provided, credentials are resolved per-account
     * to support multi-account setups. Otherwise, the default service is used.
     *
     * @param  class-string<Tool>  $class    The tool class to instantiate.
     * @param  array<string, mixed> $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TaxjarService(
                accessToken: $creds->get('taxjar', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TaxjarService::class));
    }
}
