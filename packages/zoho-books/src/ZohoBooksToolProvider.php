<?php

namespace OpenCompany\Integrations\ZohoBooks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListInvoices;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksGetInvoice;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksCreateInvoice;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksUpdateInvoice;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListContacts;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksGetContact;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksCreateContact;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListItems;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksCreateItem;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksListEstimates;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksCreateEstimate;
use OpenCompany\Integrations\ZohoBooks\Tools\ZohoBooksGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class ZohoBooksToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'zoho_books';
    }

/**
     * Short metadata for the app, shown in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'invoices, contacts, items, estimates',
            'description' => 'Online accounting & invoicing',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:zoho',
        ];
    }

/**
     * Full integration metadata for the UI integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Books',
            'description' => 'Online accounting software for managing invoices, contacts, items, and estimates.',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:zoho',
            'category' => 'accounting',
            'badge' => 'verified',
            'docs_url' => 'https://www.zoho.com/books/api/v3/',
        ];
    }/**
     * Configuration schema for the Zoho Books integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'OAuth Access Token',
                'placeholder' => 'Enter your Zoho Books OAuth access token',
                'hint' => 'Generate an OAuth token via the Zoho API Console. Use the <code>ZohoBooks.invoices</code> scope.',
                'required' => true,
            ],
            [
                'key' => 'organization_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'Enter your Zoho Books organization ID',
                'hint' => 'Find your Organization ID in Zoho Books under Settings → Organization Profile.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.zohoapis.com/books/v3',
                'hint' => 'Use the default URL for Zoho Books global. For EU data centers, use <code>https://www.zohoapis.eu/books/v3</code>.',
                'default' => 'https://www.zohoapis.com/books/v3',
            ],
        ];
    }

    /**
     * Test the connection to Zoho Books using the provided config.
     *
     * @param  array<string, mixed>  $config  Configuration values (access_token, organization_id, url).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $organizationId = $config['organization_id'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.zohoapis.com/books/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($organizationId)) {
            return ['success' => false, 'error' => 'No organization ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users', [
                'organization_id' => $organizationId,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Zoho Books API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Zoho Books API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Zoho Books (organization: {$organizationId}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'organization_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all available Zoho Books tools with metadata.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'zohobooks_list_invoices' => [
                'class' => ZohoBooksListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from Zoho Books.',
                'icon' => 'ph:invoice',
            ],
            'zohobooks_get_invoice' => [
                'class' => ZohoBooksGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get details of a specific invoice.',
                'icon' => 'ph:invoice',
            ],
            'zohobooks_create_invoice' => [
                'class' => ZohoBooksCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice in Zoho Books.',
                'icon' => 'ph:invoice',
            ],
            'zohobooks_update_invoice' => [
                'class' => ZohoBooksUpdateInvoice::class,
                'type' => 'write',
                'name' => 'Update Invoice',
                'description' => 'Update an existing invoice in Zoho Books.',
                'icon' => 'ph:invoice',
            ],
            'zohobooks_list_contacts' => [
                'class' => ZohoBooksListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts (customers and vendors) from Zoho Books.',
                'icon' => 'ph:users',
            ],
            'zohobooks_get_contact' => [
                'class' => ZohoBooksGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'zohobooks_create_contact' => [
                'class' => ZohoBooksCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Zoho Books.',
                'icon' => 'ph:user-plus',
            ],
            'zohobooks_list_items' => [
                'class' => ZohoBooksListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items (products and services) from Zoho Books.',
                'icon' => 'ph:package',
            ],
            'zohobooks_create_item' => [
                'class' => ZohoBooksCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item (product or service) in Zoho Books.',
                'icon' => 'ph:plus-circle',
            ],
            'zohobooks_list_estimates' => [
                'class' => ZohoBooksListEstimates::class,
                'type' => 'read',
                'name' => 'List Estimates',
                'description' => 'List estimates from Zoho Books.',
                'icon' => 'ph:calculator',
            ],
            'zohobooks_create_estimate' => [
                'class' => ZohoBooksCreateEstimate::class,
                'type' => 'write',
                'name' => 'Create Estimate',
                'description' => 'Create a new estimate in Zoho Books.',
                'icon' => 'ph:calculator',
            ],
            'zohobooks_get_current_user' => [
                'class' => ZohoBooksGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Zoho Books user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-books.md';
    }

    /**
     * Credential fields required for the integration.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => true],
            ['key' => 'organization_id', 'type' => 'text', 'label' => 'Organization ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.zohoapis.com/books/v3'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context with 'account' for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ZohoBooksService(
                accessToken: $creds->get('zoho_books', 'access_token', '', $account),
                organizationId: $creds->get('zoho_books', 'organization_id', '', $account),
                baseUrl: $creds->get('zoho_books', 'url', 'https://www.zohoapis.com/books/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZohoBooksService::class));
    }
}
