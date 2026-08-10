<?php

namespace OpenCompany\Integrations\FreshBooks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListInvoices;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksGetInvoice;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksCreateInvoice;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListClients;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksGetClient;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListProjects;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksListPayments;
use OpenCompany\Integrations\FreshBooks\Tools\FreshBooksGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreshBooksToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'freshbooks';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'FreshBooks',
            'description' => 'Accounting & invoicing',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:freshbooks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'FreshBooks',
            'description' => 'Cloud-based accounting, invoicing, and expense management',
            'icon' => 'ph:invoice',
            'logo' => 'simple-icons:freshbooks',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.freshbooks.com/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your FreshBooks access token',
                'hint' => 'Generate an access token in your FreshBooks developer settings',
                'required' => true,
            ],
            [
                'key' => 'account_id',
                'type' => 'text',
                'label' => 'Account ID',
                'placeholder' => 'e.g., ABC123',
                'hint' => 'Your FreshBooks account ID (found in the URL or account settings)',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.freshbooks.com',
                'hint' => 'Use <code>https://api.freshbooks.com</code> for the standard API',
                'default' => 'https://api.freshbooks.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.freshbooks.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/auth/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach FreshBooks API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to FreshBooks API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'account_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'freshbooks_list_invoices' => [
                'class' => FreshBooksListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices with optional filtering.',
                'icon' => 'ph:invoice',
            ],
            'freshbooks_get_invoice' => [
                'class' => FreshBooksGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get a single invoice by ID.',
                'icon' => 'ph:invoice',
            ],
            'freshbooks_create_invoice' => [
                'class' => FreshBooksCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice.',
                'icon' => 'ph:invoice',
            ],
            'freshbooks_list_clients' => [
                'class' => FreshBooksListClients::class,
                'type' => 'read',
                'name' => 'List Clients',
                'description' => 'List clients with optional filtering.',
                'icon' => 'ph:users',
            ],
            'freshbooks_get_client' => [
                'class' => FreshBooksGetClient::class,
                'type' => 'read',
                'name' => 'Get Client',
                'description' => 'Get a single client by ID.',
                'icon' => 'ph:user',
            ],
            'freshbooks_list_projects' => [
                'class' => FreshBooksListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects with optional filtering.',
                'icon' => 'ph:folder',
            ],
            'freshbooks_list_payments' => [
                'class' => FreshBooksListPayments::class,
                'type' => 'read',
                'name' => 'List Payments',
                'description' => 'List payments with optional filtering.',
                'icon' => 'ph:credit-card',
            ],
            'freshbooks_get_current_user' => [
                'class' => FreshBooksGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/freshbooks.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'account_id', 'type' => 'text', 'label' => 'Account ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.freshbooks.com'],
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

            $service = new FreshBooksService(
                accessToken: $creds->get('freshbooks', 'access_token', '', $account),
                accountId: $creds->get('freshbooks', 'account_id', '', $account),
                baseUrl: $creds->get('freshbooks', 'url', 'https://api.freshbooks.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshBooksService::class));
    }
}
