<?php

namespace OpenCompany\Integrations\QuickBooks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListInvoices;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetInvoice;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksCreateInvoice;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListCustomers;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetCustomer;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksListAccounts;
use OpenCompany\Integrations\QuickBooks\Tools\QuickBooksGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class QuickBooksToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'quickbooks';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'accounting, invoicing, billing',
            'description' => 'QuickBooks accounting',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:quickbooks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'QuickBooks',
            'description' => 'QuickBooks Online accounting — manage invoices, customers, accounts, and financial data',
            'icon' => 'ph:book-open',
            'logo' => 'simple-icons:quickbooks',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://developer.intuit.com/app/developer/qbo/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your QuickBooks API access token',
                'hint' => 'OAuth2 access token for the QuickBooks Online API. Obtain from the Intuit OAuth flow.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.quickbooks.com/v3',
                'hint' => 'QuickBooks API base URL. Change only if using a proxy or mock server.',
                'default' => 'https://api.quickbooks.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.quickbooks.com/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/companyinfo/current');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to QuickBooks API.',
                ];
            }

            $body = $response->json() ?? [];
            $fault = $body['Fault'] ?? null;
            if ($fault) {
                $errorMessages = array_map(
                    fn(array $e) => $e['Message'] ?? 'Unknown error',
                    $fault['Error'] ?? []
                );
                $error = implode('; ', $errorMessages);
            } else {
                $error = $response->body();
            }

            return [
                'success' => false,
                'error' => "QuickBooks API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'quickbooks_list_invoices' => [
                'class' => QuickBooksListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List QuickBooks invoices.',
                'icon' => 'ph:files',
            ],
            'quickbooks_get_invoice' => [
                'class' => QuickBooksGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a QuickBooks invoice by ID.',
                'icon' => 'ph:file-text',
            ],
            'quickbooks_create_invoice' => [
                'class' => QuickBooksCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a QuickBooks invoice for a customer.',
                'icon' => 'ph:file-text',
            ],
            'quickbooks_list_customers' => [
                'class' => QuickBooksListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List QuickBooks customers.',
                'icon' => 'ph:users',
            ],
            'quickbooks_get_customer' => [
                'class' => QuickBooksGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Retrieve a QuickBooks customer by ID.',
                'icon' => 'ph:user',
            ],
            'quickbooks_list_accounts' => [
                'class' => QuickBooksListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List QuickBooks accounts (chart of accounts).',
                'icon' => 'ph:bank',
            ],
            'quickbooks_get_current_user' => [
                'class' => QuickBooksGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user / company info and verify API connection.',
                'icon' => 'ph:book-open',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/quickbooks.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.quickbooks.com/v3'],
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

            $service = new QuickBooksService(
                accessToken: $creds->get('quickbooks', 'access_token', '', $account),
                baseUrl: $creds->get('quickbooks', 'base_url', 'https://api.quickbooks.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(QuickBooksService::class));
    }
}
