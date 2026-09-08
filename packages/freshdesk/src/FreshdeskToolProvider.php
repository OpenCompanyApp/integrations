<?php

namespace OpenCompany\Integrations\Freshdesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskListTickets;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskGetTicket;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskCreateTicket;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskUpdateTicket;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskDeleteTicket;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskListContacts;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskGetContact;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskCreateContact;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskListAgents;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskGetAgent;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskListConversations;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskCreateReply;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskCreateNote;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskListCompanies;
use OpenCompany\Integrations\Freshdesk\Tools\FreshdeskGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Freshdesk tool provider — registers all Freshdesk tools and integration metadata.
 *
 * Implements ConfigurableIntegration for the settings UI and ToolProvider
 * for tool registration with the core platform.
 */
class FreshdeskToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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

    public function appName(): string
    {
        return 'freshdesk';
    }

    public function appMeta(): array
    {
        return [
            'label'       => 'Freshdesk',
            'description' => 'Helpdesk & customer support',
            'icon'        => 'ph:headset',
            'logo'        => 'simple-icons:freshdesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name'        => 'Freshdesk',
            'description' => 'Customer support and helpdesk platform',
            'icon'        => 'ph:headset',
            'logo'        => 'simple-icons:freshdesk',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://developers.freshdesk.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_key',
                'type'        => 'secret',
                'label'       => 'API Key',
                'placeholder' => 'Enter your Freshdesk API key',
                'hint'        => 'Find your API key in Freshdesk Profile Settings → API Credentials',
                'required'    => true,
            ],
            [
                'key'         => 'domain',
                'type'        => 'string',
                'label'       => 'Domain',
                'placeholder' => 'mycompany',
                'hint'        => 'Your Freshdesk subdomain (the part before <code>.freshdesk.com</code>)',
                'required'    => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $domain = rtrim($config['domain'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if (empty($domain)) {
            return ['success' => false, 'error' => 'No domain provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, 'X')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get("https://{$domain}.freshdesk.com/api/v2/agents/me");

            if (!$response->successful()) {
                $error = $response->json('message') ?? "HTTP {$response->status()}";
                return ['success' => false, 'error' => "Connection failed: {$error}"];
            }

            $agent = $response->json();
            $name = trim(($agent['contact']['first_name'] ?? '') . ' ' . ($agent['contact']['last_name'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Freshdesk as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'domain'  => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'freshdesk_list_tickets' => [
                'class'       => FreshdeskListTickets::class,
                'type'        => 'read',
                'name'        => 'List Tickets',
                'description' => 'List support tickets with optional filters.',
                'icon'        => 'ph:list',
            ],
            'freshdesk_get_ticket' => [
                'class'       => FreshdeskGetTicket::class,
                'type'        => 'read',
                'name'        => 'Get Ticket',
                'description' => 'Get details of a specific ticket.',
                'icon'        => 'ph:ticket',
            ],
            'freshdesk_create_ticket' => [
                'class'       => FreshdeskCreateTicket::class,
                'type'        => 'write',
                'name'        => 'Create Ticket',
                'description' => 'Create a new support ticket.',
                'icon'        => 'ph:plus-circle',
            ],
            'freshdesk_update_ticket' => [
                'class'       => FreshdeskUpdateTicket::class,
                'type'        => 'write',
                'name'        => 'Update Ticket',
                'description' => 'Update an existing ticket.',
                'icon'        => 'ph:pencil',
            ],
            'freshdesk_delete_ticket' => [
                'class'       => FreshdeskDeleteTicket::class,
                'type'        => 'write',
                'name'        => 'Delete Ticket',
                'description' => 'Delete a ticket permanently.',
                'icon'        => 'ph:trash',
            ],
            'freshdesk_list_contacts' => [
                'class'       => FreshdeskListContacts::class,
                'type'        => 'read',
                'name'        => 'List Contacts',
                'description' => 'List customer contacts.',
                'icon'        => 'ph:address-book',
            ],
            'freshdesk_get_contact' => [
                'class'       => FreshdeskGetContact::class,
                'type'        => 'read',
                'name'        => 'Get Contact',
                'description' => 'Get details of a specific contact.',
                'icon'        => 'ph:user',
            ],
            'freshdesk_create_contact' => [
                'class'       => FreshdeskCreateContact::class,
                'type'        => 'write',
                'name'        => 'Create Contact',
                'description' => 'Create a new customer contact.',
                'icon'        => 'ph:user-plus',
            ],
            'freshdesk_list_agents' => [
                'class'       => FreshdeskListAgents::class,
                'type'        => 'read',
                'name'        => 'List Agents',
                'description' => 'List helpdesk agents.',
                'icon'        => 'ph:users',
            ],
            'freshdesk_get_agent' => [
                'class'       => FreshdeskGetAgent::class,
                'type'        => 'read',
                'name'        => 'Get Agent',
                'description' => 'Get details of a specific agent.',
                'icon'        => 'ph:user-circle',
            ],
            'freshdesk_list_conversations' => [
                'class'       => FreshdeskListConversations::class,
                'type'        => 'read',
                'name'        => 'List Conversations',
                'description' => 'List conversations (replies and notes) on a ticket.',
                'icon'        => 'ph:chat',
            ],
            'freshdesk_create_reply' => [
                'class'       => FreshdeskCreateReply::class,
                'type'        => 'write',
                'name'        => 'Create Reply',
                'description' => 'Reply to a ticket.',
                'icon'        => 'ph:chat-circle-text',
            ],
            'freshdesk_create_note' => [
                'class'       => FreshdeskCreateNote::class,
                'type'        => 'write',
                'name'        => 'Create Note',
                'description' => 'Add a private note to a ticket.',
                'icon'        => 'ph:note',
            ],
            'freshdesk_list_companies' => [
                'class'       => FreshdeskListCompanies::class,
                'type'        => 'read',
                'name'        => 'List Companies',
                'description' => 'List customer companies.',
                'icon'        => 'ph:buildings',
            ],
            'freshdesk_get_current_user' => [
                'class'       => FreshdeskGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the currently authenticated agent (verify auth).',
                'icon'        => 'ph:identification-badge',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/freshdesk.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'domain', 'type' => 'string', 'label' => 'Domain', 'required' => true],
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

            $service = new FreshdeskService(
                apiKey: $creds->get('freshdesk', 'api_key', '', $account),
                domain: $creds->get('freshdesk', 'domain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(FreshdeskService::class));
    }
}
