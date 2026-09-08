<?php

namespace OpenCompany\Integrations\Zendesk;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTickets;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListUsers;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetUser;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListOrganizations;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskAddTags;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskApplyMacro;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateArticle;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskCreateUser;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskDeleteTicket;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskGetArticle;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListGroups;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListMacros;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListSections;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTicketComments;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskListTicketFields;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSearchArticles;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSearchTickets;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskSetTags;
use OpenCompany\Integrations\Zendesk\Tools\ZendeskUpdateTicket;
/**
 * Registers all Zendesk tools and provides integration metadata, configuration schema, and connection testing.
 */
class ZendeskToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'zendesk';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Zendesk',
            'description' => 'Customer support platform',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zendesk',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Zendesk',
            'description' => 'Customer support platform – tickets, users, and organizations',
            'icon' => 'ph:headset',
            'logo' => 'simple-icons:zendesk',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.zendesk.com/api-reference/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'dG9rZW4...',
                'hint' => 'Create an OAuth token or API token in Zendesk Admin → API. Use Bearer token authentication.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.zendesk.com/v2',
                'hint' => 'Override only if using a custom Zendesk instance. Defaults to <code>https://api.zendesk.com/v2</code>.',
                'default' => 'https://api.zendesk.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.zendesk.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Create one in Zendesk Admin → API.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $user = $data['user'] ?? [];
                $name = trim(($user['name'] ?? '') . ' <' . ($user['email'] ?? '') . '>');

                return [
                    'success' => true,
                    'message' => "Connected to Zendesk as {$name}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['error'] ?? $body['description'] ?? $body['message'] ?? $response->body();

            if (is_array($error)) {
                $error = json_encode($error);
            }

            return [
                'success' => false,
                'error' => 'Zendesk API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'zendesk_create_ticket' => [
                'class' => ZendeskCreateTicket::class,
                'type' => 'write',
                'name' => 'Create Ticket',
                'description' => 'Create a new ticket in Zendesk. Requires a subject and description. Optionally set priority, type, status, and assignee. Returns the created ticket with its ID.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_get_current_user' => [
                'class' => ZendeskGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Retrieve the currently authenticated Zendesk user. Returns the user\'s ID, name, email, role, and avatar. Useful for identifying which account or token is in use.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_get_ticket' => [
                'class' => ZendeskGetTicket::class,
                'type' => 'read',
                'name' => 'Get Ticket',
                'description' => 'Retrieve a Zendesk ticket by its ID. Returns the full ticket including subject, description, status, priority, and metadata.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_get_user' => [
                'class' => ZendeskGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Retrieve a Zendesk user by its ID. Returns the user\'s ID, name, email, role, and profile details.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_list_organizations' => [
                'class' => ZendeskListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Zendesk organizations with pagination. Returns organization IDs, names, and created dates. Use per_page and page for pagination.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_list_tickets' => [
                'class' => ZendeskListTickets::class,
                'type' => 'read',
                'name' => 'List Tickets',
                'description' => 'List Zendesk tickets with pagination and filtering. Returns ticket IDs, subjects, status, priority, and created dates. Use per_page, page, and status for pagination and filtering.',
                'icon' => 'ph:wrench',
            ],
            'zendesk_list_users' => [
                'class' => ZendeskListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List Zendesk users with pagination and filtering. Returns user IDs, names, emails, and roles. Use per_page, page, and role for pagination and filtering.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/zendesk.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.zendesk.com/v2'],
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
     * Resolve the ZendeskService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ZendeskService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ZendeskService(
                accessToken: $creds->get('zendesk', 'access_token', '', $account),
                baseUrl: $creds->get('zendesk', 'base_url', 'https://api.zendesk.com/v2', $account),
            );
        }

        return app(ZendeskService::class);
    }
}
