<?php

namespace OpenCompany\Integrations\Paddle;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Paddle\Tools\PaddleCreateCustomer;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetCurrentUser;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetCustomer;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetTransaction;
use OpenCompany\Integrations\Paddle\Tools\PaddleListCustomers;
use OpenCompany\Integrations\Paddle\Tools\PaddleListProducts;
use OpenCompany\Integrations\Paddle\Tools\PaddleListTransactions;

/**
 * Registers Paddle tools and metadata for integration discovery.
 *
 * Exposes Paddle Billing API operations for transactions, customers,
 * products, and lightweight credential verification.
 */
class PaddleToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'paddle';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Paddle',
            'description' => 'Paddle integration for Laravel — manage transactions, customers, and products.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Paddle',
            'description' => 'Paddle integration for Laravel — manage transactions, customers, and products.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.paddle.com/api-reference/overview',
        ];
    }

    /**
     * Get the configuration schema for the Paddle integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Paddle API access token',
                'hint' => 'Generate an access token in your Paddle dashboard under "Developer > Authentication".',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://sandbox-api.paddle.com',
                'hint' => 'Use <code>https://sandbox-api.paddle.com</code> for testing, or <code>https://api.paddle.com</code> for production.',
                'default' => 'https://sandbox-api.paddle.com',
            ],
        ];
    }

    /**
     * Test the connection to the Paddle API.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://sandbox-api.paddle.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/transactions', ['per_page' => 1]);

            $json = $response->json();

            if (!$response->successful()) {
                $error = $json['error']['detail'] ?? $json['error']['message'] ?? $json['error'] ?? "HTTP {$response->status()}";

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Paddle API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Paddle API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'paddle_list_transactions' => [
                'class' => PaddleListTransactions::class,
                'type' => 'read',
                'name' => 'List Transactions',
                'description' => 'List Paddle transactions with optional filters.',
                'icon' => 'ph:receipt',
            ],
            'paddle_get_transaction' => [
                'class' => PaddleGetTransaction::class,
                'type' => 'read',
                'name' => 'Get Transaction',
                'description' => 'Get details of a specific Paddle transaction.',
                'icon' => 'ph:receipt',
            ],
            'paddle_list_customers' => [
                'class' => PaddleListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List Paddle customers with optional filters.',
                'icon' => 'ph:users',
            ],
            'paddle_get_customer' => [
                'class' => PaddleGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details of a specific Paddle customer.',
                'icon' => 'ph:user',
            ],
            'paddle_create_customer' => [
                'class' => PaddleCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer in Paddle.',
                'icon' => 'ph:user-plus',
            ],
            'paddle_list_products' => [
                'class' => PaddleListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List Paddle products with optional filters.',
                'icon' => 'ph:package',
            ],
            'paddle_get_current_user' => [
                'class' => PaddleGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Health Check',
                'description' => 'Verify Paddle API connectivity by fetching a transaction.',
                'icon' => 'ph:heartbeat',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/paddle.md';
    }

    /**
     * Get the credential fields for the integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Paddle API URL', 'required' => false, 'default' => 'https://sandbox-api.paddle.com'],
        ];
    }

    /**
     * Whether this class acts as an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new PaddleService(
                accessToken: $creds->get('paddle', 'access_token', '', $account),
                baseUrl: $creds->get('paddle', 'url', 'https://sandbox-api.paddle.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PaddleService::class));
    }
}
