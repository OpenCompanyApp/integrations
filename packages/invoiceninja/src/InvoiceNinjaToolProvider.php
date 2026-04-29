<?php

namespace OpenCompany\Integrations\InvoiceNinja;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaCreateClient;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaCreateInvoice;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaGetCurrentUser;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaGetInvoice;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListClients;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListInvoices;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListPayments;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaListProducts;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class InvoiceNinjaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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

/**
     * The application identifier used for credential resolution.
     */
    public function appName(): string
    {
        return 'invoiceninja';
    }

    /**
     * Metadata displayed in the integration UI.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Invoice Ninja',
            'description' => 'Invoicing & accounting',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:invoiceninja',
        ];
    }

    /**
     * Integration metadata for the marketplace / integration catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Invoice Ninja',
            'description' => 'Invoicing, billing and accounting platform',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:invoiceninja',
            'category' => 'accounting',
            'badge' => 'verified',
            'docs_url' => 'https://invoiceninja.github.io/docs/api/',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Invoice Ninja API token',
                'hint' => 'Generate an API token in your Invoice Ninja account under Settings → Account Management → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://invoicing.yourdomain.com',
                'hint' => 'The base URL of your Invoice Ninja instance (self-hosted or cloud)',
                'default' => 'https://invoicing.yourdomain.com',
            ],
        ];
    }

    /**
     * Test the connection to Invoice Ninja using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://invoicing.yourdomain.com', '/');

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
                'X-Api-Token' => $apiToken,
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Invoice Ninja API at {$baseUrl}. Check the URL.",
                ];
            }

            if ($response->successful()) {
                $name = $json['data']['first_name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Invoice Ninja as {$name}.",
                ];
            }

            $error = $json['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Invoice Ninja API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'invoiceninja_list_invoices' => [
                'class' => InvoiceNinjaListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional filtering.',
                'icon' => 'ph:list-bullets',
            ],
            'invoiceninja_get_invoice' => [
                'class' => InvoiceNinjaGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get a single invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'invoiceninja_create_invoice' => [
                'class' => InvoiceNinjaCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice.',
                'icon' => 'ph:plus-circle',
            ],
            'invoiceninja_list_clients' => [
                'class' => InvoiceNinjaListClients::class,
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List clients with optional filtering.',
                'icon' => 'ph:users',
            ],
            'invoiceninja_create_client' => [
                'class' => InvoiceNinjaCreateClient::class,
                'type' => 'write',
                'name' => 'Create Client',
                'description' => 'Create a new client.',
                'icon' => 'ph:user-plus',
            ],
            'invoiceninja_list_products' => [
                'class' => InvoiceNinjaListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products with optional filtering.',
                'icon' => 'ph:package',
            ],
            'invoiceninja_list_payments' => [
                'class' => InvoiceNinjaListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments with optional filtering.',
                'icon' => 'ph:credit-card',
            ],
            'invoiceninja_get_current_user' => [
                'class' => InvoiceNinjaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/invoiceninja.md';
    }

    /**
     * Credential fields for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Instance URL', 'required' => false, 'default' => 'https://invoicing.yourdomain.com'],
        ];
    }

    /**
     * Indicate this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the InvoiceNinjaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): InvoiceNinjaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new InvoiceNinjaService(
                apiToken: $creds->get('invoiceninja', 'api_token', '', $account),
                baseUrl: $creds->get('invoiceninja', 'url', 'https://invoicing.yourdomain.com', $account),
            );
        }

        return app(InvoiceNinjaService::class);
    }
}
