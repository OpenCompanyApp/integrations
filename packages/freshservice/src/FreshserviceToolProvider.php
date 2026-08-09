<?php

namespace OpenCompany\Integrations\Freshservice;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceListTickets;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceGetTicket;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceCreateTicket;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceUpdateTicket;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceDeleteTicket;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceListAgents;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceGetAgent;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceListAssets;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceGetAsset;
use OpenCompany\Integrations\Freshservice\Tools\FreshserviceGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class FreshserviceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'freshservice';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Freshservice',
            'description' => 'Freshservice ITSM integration for Laravel — manage tickets, agents, and assets.',
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
            'name' => 'Freshservice',
            'description' => 'Freshservice ITSM integration for Laravel — manage tickets, agents, and assets.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
        ];
    }
/**
     * Get the configuration schema for the integration settings UI.
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
                'placeholder' => 'Enter your Freshservice API key',
                'hint' => 'Find your API key in Freshservice under Profile Settings → API Key',
                'required' => true,
            ],
            [
                'key' => 'domain',
                'type' => 'string',
                'label' => 'Domain',
                'placeholder' => 'acme',
                'hint' => 'Your Freshservice domain (e.g., <code>acme</code> for <code>acme.freshservice.com</code>)',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Freshservice API.
     *
     * @param  array<string, mixed>  $config  The configuration values to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = trim($config['domain'] ?? '');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No domain provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, 'X')->timeout(10)->get(
                "https://{$domain}.freshservice.com/api/v2/agents/me"
            );

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Freshservice API at {$domain}.freshservice.com. Check the domain.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Freshservice at {$domain}.freshservice.com.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for the configuration fields.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'freshservice_list_tickets' => [
                'class' => FreshserviceListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List support tickets with optional pagination and filtering.',
                'icon' => 'ph:list',
            ],
            'freshservice_get_ticket' => [
                'class' => FreshserviceGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get details of a specific ticket.',
                'icon' => 'ph:ticket',
            ],
            'freshservice_create_ticket' => [
                'class' => FreshserviceCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new support ticket.',
                'icon' => 'ph:plus-circle',
            ],
            'freshservice_update_ticket' => [
                'class' => FreshserviceUpdateTicket::class,
                'type' => 'write',
                'name' => 'Update Ticket',
                'description' => 'Update an existing ticket.',
                'icon' => 'ph:pencil',
            ],
            'freshservice_delete_ticket' => [
                'class' => FreshserviceDeleteTicket::class,
                'type' => 'write',
                'name' => 'Delete Ticket',
                'description' => 'Delete a ticket.',
                'icon' => 'ph:trash',
            ],
            'freshservice_list_agents' => [
                'class' => FreshserviceListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List all agents in the account.',
                'icon' => 'ph:users',
            ],
            'freshservice_get_agent' => [
                'class' => FreshserviceGetAgent::class,
                'type' => 'read',
                'name' => 'Get Agent',
                'description' => 'Get details of a specific agent.',
                'icon' => 'ph:user',
            ],
            'freshservice_list_assets' => [
                'class' => FreshserviceListAssets::class,
                'type' => 'read',
                'name' => 'List Assets',
                'description' => 'List IT assets with optional pagination.',
                'icon' => 'ph:package',
            ],
            'freshservice_get_asset' => [
                'class' => FreshserviceGetAsset::class,
                'type' => 'read',
                'name' => 'Get Asset',
                'description' => 'Get details of a specific asset.',
                'icon' => 'ph:package',
            ],
            'freshservice_get_current_user' => [
                'class' => FreshserviceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated agent.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript documentation file.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/freshservice.md';
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
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with the given context.
     *
     * @param  string  $class   The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context including optional 'account' for multi-account support.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new FreshserviceService(
                apiKey: $creds->get('freshservice', 'api_key', '', $account),
                domain: $creds->get('freshservice', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshserviceService::class));
    }
}
