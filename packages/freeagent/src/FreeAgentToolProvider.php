<?php

namespace OpenCompany\Integrations\FreeAgent;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListInvoices;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentGetInvoice;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentCreateInvoice;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListContacts;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentGetContact;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentCreateContact;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListProjects;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentListExpenses;
use OpenCompany\Integrations\FreeAgent\Tools\FreeAgentGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreeAgentToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'freeagent';
    }    /**
     * Get the configuration schema for setting up the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your FreeAgent OAuth2 access token',
                'hint' => 'Generate an OAuth2 access token via the FreeAgent developer portal at <code>https://dev.freeagent.com</code>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.freeagent.com/v2',
                'hint' => 'Use <code>https://api.freeagent.com/v2</code> for the production API, or a sandbox URL for testing',
                'default' => 'https://api.freeagent.com/v2',
            ],
        ];
    }

    /**
     * Test the connection to the FreeAgent API.
     *
     * @param  array<string, mixed>  $config  Configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.freeagent.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach FreeAgent API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to FreeAgent API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, mixed>
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
            'freeagent_list_invoices' => [
                'class' => FreeAgentListInvoices::class,
                'type' => 'read',
                'name' => 'List Invoices',
                'description' => 'List invoices from FreeAgent.',
                'icon' => 'ph:receipt',
            ],
            'freeagent_get_invoice' => [
                'class' => FreeAgentGetInvoice::class,
                'type' => 'read',
                'name' => 'Get Invoice',
                'description' => 'Get details of a specific invoice.',
                'icon' => 'ph:receipt',
            ],
            'freeagent_create_invoice' => [
                'class' => FreeAgentCreateInvoice::class,
                'type' => 'write',
                'name' => 'Create Invoice',
                'description' => 'Create a new invoice in FreeAgent.',
                'icon' => 'ph:plus-circle',
            ],
            'freeagent_list_contacts' => [
                'class' => FreeAgentListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from FreeAgent.',
                'icon' => 'ph:users',
            ],
            'freeagent_get_contact' => [
                'class' => FreeAgentGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon' => 'ph:user',
            ],
            'freeagent_create_contact' => [
                'class' => FreeAgentCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in FreeAgent.',
                'icon' => 'ph:user-plus',
            ],
            'freeagent_list_projects' => [
                'class' => FreeAgentListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects from FreeAgent.',
                'icon' => 'ph:folder',
            ],
            'freeagent_list_expenses' => [
                'class' => FreeAgentListExpenses::class,
                'type' => 'read',
                'name' => 'List Expenses',
                'description' => 'List expenses from FreeAgent.',
                'icon' => 'ph:currency-dollar',
            ],
            'freeagent_get_current_user' => [
                'class' => FreeAgentGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated FreeAgent user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/freeagent.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.freeagent.com/v2'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account context.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context including optional 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FreeAgentService(
                accessToken: $creds->get('freeagent', 'access_token', '', $account),
                baseUrl: $creds->get('freeagent', 'url', 'https://api.freeagent.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreeAgentService::class));
    }
}
