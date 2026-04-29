<?php

namespace OpenCompany\Integrations\Xero;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Xero\Tools\XeroListInvoices;
use OpenCompany\Integrations\Xero\Tools\XeroGetInvoice;
use OpenCompany\Integrations\Xero\Tools\XeroCreateInvoice;
use OpenCompany\Integrations\Xero\Tools\XeroListContacts;
use OpenCompany\Integrations\Xero\Tools\XeroGetContact;
use OpenCompany\Integrations\Xero\Tools\XeroListAccounts;
use OpenCompany\Integrations\Xero\Tools\XeroGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Xero tools and provides integration metadata, configuration schema, and connection testing.
 */
class XeroToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'xero';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Xero',
            'description' => 'Cloud accounting platform',
            'icon' => 'ph:calculator',
            'logo' => 'simple-icons:xero',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Xero',
            'description' => 'Cloud accounting platform – invoices, contacts, and chart of accounts',
            'icon' => 'ph:calculator',
            'logo' => 'simple-icons:xero',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://developer.xero.com/documentation/api/accounting/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'eyJhbG...',
                'hint' => 'Xero OAuth2 access token. Generate one in the Xero Developer Portal → My Apps → Your App.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.xero.com/api.xro/2.0',
                'hint' => 'Override only if using a custom Xero API endpoint. Defaults to <code>https://api.xero.com/api.xro/2.0</code>.',
                'default' => 'https://api.xero.com/api.xro/2.0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.xero.com/api.xro/2.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate one in the Xero Developer Portal.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/Users');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $users = $data['Users'] ?? [];
                $name = '';
                if (! empty($users)) {
                    $name = trim(($users[0]['FirstName'] ?? '') . ' ' . ($users[0]['LastName'] ?? ''));
                }

                return [
                    'success' => true,
                    'message' => $name
                        ? "Connected to Xero as {$name}."
                        : 'Connected to Xero successfully.',
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['Message'] ?? $body['Type'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Xero API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
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
            // Invoices
            'xero_list_invoices' => [
                'class' => XeroListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List Xero invoices with pagination and filtering.',
                'icon' => 'ph:list',
            ],
            'xero_get_invoice' => [
                'class' => XeroGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Retrieve a Xero invoice by ID.',
                'icon' => 'ph:file-text',
            ],
            'xero_create_invoice' => [
                'class' => XeroCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new Xero invoice.',
                'icon' => 'ph:file-plus',
            ],
            // Contacts
            'xero_list_contacts' => [
                'class' => XeroListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List Xero contacts with pagination.',
                'icon' => 'ph:users',
            ],
            'xero_get_contact' => [
                'class' => XeroGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Retrieve a Xero contact by ID.',
                'icon' => 'ph:user',
            ],
            // Accounts
            'xero_list_accounts' => [
                'class' => XeroListAccounts::class,
                'type' => 'read',
                'name' => 'List Accounts',
                'description' => 'List Xero chart of accounts.',
                'icon' => 'ph:buildings',
            ],
            'xero_get_current_user' => [
                'class' => XeroGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Xero user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/xero.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.xero.com/api.xro/2.0'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the XeroService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): XeroService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new XeroService(
                accessToken: $creds->get('xero', 'access_token', '', $account),
                baseUrl: $creds->get('xero', 'base_url', 'https://api.xero.com/api.xro/2.0', $account),
            );
        }

        return app(XeroService::class);
    }
}
