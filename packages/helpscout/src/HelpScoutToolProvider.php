<?php

namespace OpenCompany\Integrations\HelpScout;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutListConversations;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutGetConversation;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutCreateConversation;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutUpdateConversation;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutListCustomers;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutGetCustomer;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutCreateCustomer;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutListMailboxes;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutGetMailbox;
use OpenCompany\Integrations\HelpScout\Tools\HelpScoutGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class HelpScoutToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * The application name used as the integration identifier.
     */
    public function appName(): string
    {
        return 'helpscout';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Helpscout',
            'description' => 'HelpScout integration for Laravel — manage conversations, customers, and mailboxes.',
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
            'name' => 'Helpscout',
            'description' => 'HelpScout integration for Laravel — manage conversations, customers, and mailboxes.',
            'icon' => 'ph:plug',
            'logo' => 'ph:plug',
            'category' => 'data',
            'badge' => 'verified',
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
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your HelpScout OAuth2 access token',
                'hint' => 'Generate an access token in your HelpScout account under <strong>Profile → Authentication</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.helpscout.net/v2',
                'hint' => 'The HelpScout API v2 base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.helpscout.net/v2',
            ],
        ];
    }

    /**
     * Test the connection to the HelpScout API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.helpscout.net/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach HelpScout API at {$baseUrl}. Check the URL and access token.",
                ];
            }

            $userName = ($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? '');
            $userName = trim($userName) ?: 'Unknown user';

            return [
                'success' => true,
                'message' => "Connected to HelpScout as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration values.
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
     * Return the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'helpscout_list_conversations' => [
                'class' => HelpScoutListConversations::class,
                'type' => 'read',
                'name' => 'List Conversations',
                'description' => 'List support conversations with optional filters.',
                'icon' => 'ph:chat-circle-text',
            ],
            'helpscout_get_conversation' => [
                'class' => HelpScoutGetConversation::class,
                'type' => 'read',
                'name' => 'Get Conversation',
                'description' => 'Get details of a specific conversation.',
                'icon' => 'ph:chat-circle-text',
            ],
            'helpscout_create_conversation' => [
                'class' => HelpScoutCreateConversation::class,
                'type' => 'write',
                'name' => 'Create Conversation',
                'description' => 'Create a new support conversation.',
                'icon' => 'ph:plus-circle',
            ],
            'helpscout_update_conversation' => [
                'class' => HelpScoutUpdateConversation::class,
                'type' => 'write',
                'name' => 'Update Conversation',
                'description' => 'Update an existing conversation (status, assignee, tags).',
                'icon' => 'ph:pencil-simple',
            ],
            'helpscout_list_customers' => [
                'class' => HelpScoutListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List or search customers.',
                'icon' => 'ph:users',
            ],
            'helpscout_get_customer' => [
                'class' => HelpScoutGetCustomer::class,
                'type' => 'read',
                'name' => 'Get Customer',
                'description' => 'Get details of a specific customer.',
                'icon' => 'ph:user',
            ],
            'helpscout_create_customer' => [
                'class' => HelpScoutCreateCustomer::class,
                'type' => 'write',
                'name' => 'Create Customer',
                'description' => 'Create a new customer.',
                'icon' => 'ph:user-plus',
            ],
            'helpscout_list_mailboxes' => [
                'class' => HelpScoutListMailboxes::class,
                'type' => 'read',
                'name' => 'List Mailboxes',
                'description' => 'List all mailboxes.',
                'icon' => 'ph:envelope',
            ],
            'helpscout_get_mailbox' => [
                'class' => HelpScoutGetMailbox::class,
                'type' => 'read',
                'name' => 'Get Mailbox',
                'description' => 'Get details of a specific mailbox.',
                'icon' => 'ph:envelope',
            ],
            'helpscout_get_current_user' => [
                'class' => HelpScoutGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/helpscout.md';
    }

    /**
     * Credential field definitions for quick-setup.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.helpscout.net/v2'],
        ];
    }

    /**
     * Confirm this is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new HelpScoutService(
                accessToken: $creds->get('helpscout', 'access_token', '', $account),
                baseUrl: $creds->get('helpscout', 'url', 'https://api.helpscout.net/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(HelpScoutService::class));
    }
}
