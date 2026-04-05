<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskCreateTicket;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskGetCurrentUser;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskGetTicket;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListArticles;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListContacts;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListDepartments;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListTickets;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskUpdateTicket;

/**
 * Tool provider for the Zoho Desk integration.
 *
 * Implements ConfigurableIntegration for dynamic config schema,
 * connection testing, and multi-account credential resolution.
 */
class ZohoDeskToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The integration app name used as a key in credential and registry lookups.
     */
    public function appName(): string
    {
        return 'zoho-desk';
    }

    /**
     * Metadata shown in the OpenCompany app integration panel.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'tickets, contacts, articles, departments',
            'description' => 'Help desk & customer support',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zoho',
        ];
    }

    /**
     * Integration metadata displayed during setup and in docs.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Desk',
            'description' => 'Customer support help desk — tickets, contacts, knowledge base, and departments',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zoho',
            'category' => 'support',
            'badge' => 'verified',
            'docs_url' => 'https://desk.zoho.com/DeskAPIDocument',
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
                'placeholder' => 'Enter your Zoho Desk OAuth2 access token',
                'hint' => 'Generate an OAuth2 access token in your Zoho Desk admin console under "Developer Space" → "Connections". Use the <code>ZohoDesk.tickets.ALL</code> scope.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://desk.zoho.com/api/v1',
                'hint' => 'The base URL for the Zoho Desk REST API. Defaults to <code>https://desk.zoho.com/api/v1</code>. Change if using a regional endpoint (e.g., <code>https://desk.zoho.eu/api/v1</code>).',
                'default' => 'https://desk.zoho.com/api/v1',
            ],
            [
                'key' => 'org_id',
                'type' => 'text',
                'label' => 'Organization ID',
                'placeholder' => 'e.g., 12345678901',
                'hint' => 'Your Zoho Desk organization ID. Find it in Settings → Organization Profile. Required for most API calls.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Zoho Desk API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://desk.zoho.com/api/v1', '/');
        $orgId = $config['org_id'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders(array_filter([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'orgId' => $orgId ?: null,
            ]))->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json('response') ?? $response->json();
                $name = is_array($user)
                    ? ($user['firstName'] ?? $user['name'] ?? 'Unknown')
                    : 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Zoho Desk as {$name}.",
                ];
            }

            $error = $response->json('errors.0.message')
                ?? $response->json('message')
                ?? $response->body();

            return [
                'success' => false,
                'error' => 'Zoho Desk API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for integration config values.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
            'org_id' => 'nullable|string',
        ];
    }

    /**
     * Return the map of tool keys to their class, type, name, description, and icon.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'zohodesk_list_tickets' => [
                'class' => ZohoDeskListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List support tickets with optional filtering.',
                'icon' => 'ph:ticket',
            ],
            'zohodesk_get_ticket' => [
                'class' => ZohoDeskGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get a single ticket by ID with full details.',
                'icon' => 'ph:ticket',
            ],
            'zohodesk_create_ticket' => [
                'class' => ZohoDeskCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new support ticket.',
                'icon' => 'ph:plus-circle',
            ],
            'zohodesk_update_ticket' => [
                'class' => ZohoDeskUpdateTicket::class,
                'type' => 'write',
                'name' => 'Update Ticket',
                'description' => 'Update an existing ticket (status, priority, assignee, etc.).',
                'icon' => 'ph:pencil-simple',
            ],
            'zohodesk_list_contacts' => [
                'class' => ZohoDeskListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List customer contacts.',
                'icon' => 'ph:address-book',
            ],
            'zohodesk_list_articles' => [
                'class' => ZohoDeskListArticles::class,
                'type' => 'read',
                'name' => 'List Articles',
                'description' => 'List knowledge base articles.',
                'icon' => 'ph:article',
            ],
            'zohodesk_list_departments' => [
                'class' => ZohoDeskListDepartments::class,
                'type' => 'read',
                'name' => 'List Departments',
                'description' => 'List all departments in the organization.',
                'icon' => 'ph:buildings',
            ],
            'zohodesk_get_current_user' => [
                'class' => ZohoDeskGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation for agent tool usage.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-desk.md';
    }

    /**
     * Credential field definitions for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://desk.zoho.com/api/v1'],
            ['key' => 'org_id', 'type' => 'string', 'label' => 'Organization ID', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context with optional 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ZohoDeskService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Context containing an optional 'account' key.
     */
    private function resolveService(array $context = []): ZohoDeskService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZohoDeskService(
                accessToken: $creds->get('zoho-desk', 'access_token', '', $account),
                baseUrl: $creds->get('zoho-desk', 'base_url', 'https://desk.zoho.com/api/v1', $account),
                orgId: $creds->get('zoho-desk', 'org_id', '', $account),
            );
        }

        return app(ZohoDeskService::class);
    }
}
