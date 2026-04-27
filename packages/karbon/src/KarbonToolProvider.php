<?php

namespace OpenCompany\Integrations\Karbon;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Karbon\Tools\KarbonListContacts;
use OpenCompany\Integrations\Karbon\Tools\KarbonGetContact;
use OpenCompany\Integrations\Karbon\Tools\KarbonCreateContact;
use OpenCompany\Integrations\Karbon\Tools\KarbonListWorkItems;
use OpenCompany\Integrations\Karbon\Tools\KarbonGetWorkItem;
use OpenCompany\Integrations\Karbon\Tools\KarbonListUsers;
use OpenCompany\Integrations\Karbon\Tools\KarbonGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KarbonToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'karbon';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, work items, users',
            'description' => 'Practice management',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:karbon',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Karbon',
            'description' => 'Practice management platform for accounting firms — manage contacts, work items, and team collaboration.',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:karbon',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.karbonhq.com/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Karbon API access token',
                'hint' => 'Generate an access token in your Karbon account under "API Settings".',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.karbonhq.com',
                'hint' => 'Use the default Karbon API URL unless you have a custom endpoint.',
                'default' => 'https://api.karbonhq.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.karbonhq.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Karbon API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Karbon API at {$baseUrl}.",
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
        ];
    }

    public function tools(): array
    {
        return [
            'karbon_list_contacts' => [
                'class' => KarbonListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Karbon with pagination.',
                'icon' => 'ph:address-book',
            ],
            'karbon_get_contact' => [
                'class' => KarbonGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:address-book',
            ],
            'karbon_create_contact' => [
                'class' => KarbonCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Karbon.',
                'icon' => 'ph:user-plus',
            ],
            'karbon_list_work_items' => [
                'class' => KarbonListWorkItems::class,
                'type' => 'read',
                'name' => 'List Work Items',
                'description' => 'List work items with optional status and assignee filters.',
                'icon' => 'ph:list-checks',
            ],
            'karbon_get_work_item' => [
                'class' => KarbonGetWorkItem::class,
                'type' => 'read',
                'name' => 'Get Work Item',
                'description' => 'Get a single work item by ID.',
                'icon' => 'ph:list-checks',
            ],
            'karbon_list_users' => [
                'class' => KarbonListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the Karbon account.',
                'icon' => 'ph:users',
            ],
            'karbon_get_current_user' => [
                'class' => KarbonGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/karbon.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.karbonhq.com'],
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

            $service = new KarbonService(
                accessToken: $creds->get('karbon', 'access_token', '', $account),
                baseUrl: $creds->get('karbon', 'url', 'https://api.karbonhq.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(KarbonService::class));
    }
}
