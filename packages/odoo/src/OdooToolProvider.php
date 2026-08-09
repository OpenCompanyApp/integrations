<?php

namespace OpenCompany\Integrations\Odoo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Odoo\Tools\OdooListContacts;
use OpenCompany\Integrations\Odoo\Tools\OdooGetContact;
use OpenCompany\Integrations\Odoo\Tools\OdooCreateContact;
use OpenCompany\Integrations\Odoo\Tools\OdooListSalesOrders;
use OpenCompany\Integrations\Odoo\Tools\OdooListInvoices;
use OpenCompany\Integrations\Odoo\Tools\OdooListProducts;
use OpenCompany\Integrations\Odoo\Tools\OdooListLeads;
use OpenCompany\Integrations\Odoo\Tools\OdooGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class OdooToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
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
     * Get the application name used for credential resolution.
     */
    public function appName(): string
    {
        return 'odoo';
    }

/**
     * Get short metadata for the app selector UI.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Odoo ERP',
            'description' => 'ERP & CRM',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:odoo',
        ];
    }

/**
     * Get full integration metadata for the integration catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Odoo ERP',
            'description' => 'Manage contacts, sales orders, invoices, products, and leads',
            'icon' => 'ph:buildings',
            'logo' => 'simple-icons:odoo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.odoo.com/documentation/developer/api.html',
        ];
    }/**
     * Define the configuration schema for the Odoo integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Odoo API key',
                'hint' => 'Generate an API key in your Odoo instance under Settings → Users → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://your-odoo-instance.com',
                'hint' => 'The full URL of your Odoo instance (e.g., <code>https://mycompany.odoo.com</code>)',
                'required' => true,
            ],
            [
                'key' => 'database',
                'type' => 'text',
                'label' => 'Database Name',
                'placeholder' => 'mycompany',
                'hint' => 'The database name for your Odoo instance. Required for self-hosted installations.',
            ],
        ];
    }

    /**
     * Test the connection to the Odoo instance using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://your-odoo-instance.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10);

            if (!empty($config['database'])) {
                $http->withHeaders(['X-Database' => $config['database']]);
            }

            $response = $http->get($baseUrl . '/api/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = $user['name'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Odoo as {$name}.",
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Odoo API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Odoo configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'database' => 'nullable|string',
        ];
    }

    /**
     * Get the list of available Odoo tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'odoo_list_contacts' => [
                'class' => OdooListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts (customers, vendors) with pagination.',
                'icon' => 'ph:address-book',
            ],
            'odoo_get_contact' => [
                'class' => OdooGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'odoo_create_contact' => [
                'class' => OdooCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Odoo.',
                'icon' => 'ph:user-plus',
            ],
            'odoo_list_sales_orders' => [
                'class' => OdooListSalesOrders::class,
                'type' => 'read',
                'name' => 'List Sales Orders',
                'description' => 'List sales orders with pagination and filtering.',
                'icon' => 'ph:shopping-cart',
            ],
            'odoo_list_invoices' => [
                'class' => OdooListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with pagination and filtering.',
                'icon' => 'ph:receipt',
            ],
            'odoo_list_products' => [
                'class' => OdooListProducts::class,
                'type' => 'read',
                'name' => 'List Products',
                'description' => 'List products with pagination and filtering.',
                'icon' => 'ph:package',
            ],
            'odoo_list_leads' => [
                'class' => OdooListLeads::class,
                'type' => 'read',
                'name' => 'List Leads',
                'description' => 'List CRM leads and opportunities.',
                'icon' => 'ph:magnet',
            ],
            'odoo_get_current_user' => [
                'class' => OdooGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Odoo user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript API documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/odoo.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Odoo URL', 'required' => true],
            ['key' => 'database', 'type' => 'string', 'label' => 'Database Name', 'required' => false],
        ];
    }

    /**
     * Confirm this is an integration (not just a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new OdooService(
                apiKey: $creds->get('odoo', 'api_key', '', $account),
                baseUrl: $creds->get('odoo', 'url', 'https://your-odoo-instance.com', $account),
                database: $creds->get('odoo', 'database', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(OdooService::class));
    }
}
