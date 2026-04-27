<?php

namespace OpenCompany\Integrations\ZohoDesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListTickets;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskGetTicket;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskCreateTicket;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskUpdateTicket;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListContacts;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListArticles;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskListDepartments;
use OpenCompany\Integrations\ZohoDesk\Tools\ZohoDeskGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ZohoDeskToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'zoho-desk';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tickets, contacts, articles, departments',
            'description' => 'Customer support helpdesk',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zoho',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zoho Desk',
            'description' => 'Customer support and helpdesk management',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zoho',
            'category' => 'support',
            'badge' => 'verified',
            'docs_url' => 'https://desk.zoho.com/DeskAPIDocument',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Zoho Desk OAuth access token',
                'hint' => 'Generate an OAuth access token from the Zoho API Console with Desk scope',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://desk.zoho.com/api/v1',
                'hint' => 'Use the default or your regional URL (e.g., <code>https://desk.zoho.eu/api/v1</code>)',
                'default' => 'https://desk.zoho.com/api/v1',
            ],
            [
                'key' => 'org_id',
                'type' => 'string',
                'label' => 'Organization ID',
                'placeholder' => 'e.g., 1234567890',
                'hint' => 'Find your Organization ID in Zoho Desk under Setup → Organization → Organization Profile',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://desk.zoho.com/api/v1', '/');
        $orgId = $config['org_id'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        if (empty($orgId)) {
            return ['success' => false, 'error' => 'No organization ID provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'orgId' => $orgId,
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($response->successful() && $json !== null) {
                $userName = $json['firstName'] ?? 'Unknown';
                return [
                    'success' => true,
                    'message' => "Connected to Zoho Desk as {$userName}.",
                ];
            }

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Invalid access token. Please check your OAuth credentials.'];
            }

            return [
                'success' => false,
                'error' => "Zoho Desk API returned HTTP {$response->status()}. Check your configuration.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
            'org_id' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'zohodesk_list_tickets' => [
                'class' => ZohoDeskListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List support tickets with optional filters.',
                'icon' => 'ph:ticket',
            ],
            'zohodesk_get_ticket' => [
                'class' => ZohoDeskGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Get details of a specific support ticket.',
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
                'description' => 'Update an existing support ticket.',
                'icon' => 'ph:pencil-simple',
            ],
            'zohodesk_list_contacts' => [
                'class' => ZohoDeskListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts from Zoho Desk.',
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
                'description' => 'List support departments.',
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

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/zoho-desk.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://desk.zoho.com/api/v1'],
            ['key' => 'org_id', 'type' => 'string', 'label' => 'Organization ID', 'required' => true],
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

            $service = new ZohoDeskService(
                accessToken: $creds->get('zoho-desk', 'access_token', '', $account),
                baseUrl: $creds->get('zoho-desk', 'url', 'https://desk.zoho.com/api/v1', $account),
                orgId: $creds->get('zoho-desk', 'org_id', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ZohoDeskService::class));
    }
}
