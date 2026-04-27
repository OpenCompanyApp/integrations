<?php

namespace OpenCompany\Integrations\Autopilot;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotListContacts;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotGetContact;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotCreateContact;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotListLists;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotGetList;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotListJourneys;
use OpenCompany\Integrations\Autopilot\Tools\AutopilotGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AutopilotToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'autopilot';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, lists, journeys',
            'description' => 'Marketing automation',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:autopilot',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Autopilot',
            'description' => 'Marketing automation and contact management',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:autopilot',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://autopilot.docs.apiary.io/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Autopilot API key',
                'hint' => 'Find your API key in your Autopilot account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.autopilotapp.com/v1',
                'hint' => 'The Autopilot API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.autopilotapp.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.autopilotapp.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'autopilot-sdk-version' => '2.0',
                ])
                ->timeout(10)
                ->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Autopilot API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Autopilot API successfully.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'autopilot_list_contacts' => [
                'class' => AutopilotListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in your Autopilot account.',
                'icon' => 'ph:users',
            ],
            'autopilot_get_contact' => [
                'class' => AutopilotGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a specific contact.',
                'icon' => 'ph:user',
            ],
            'autopilot_create_contact' => [
                'class' => AutopilotCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create or update a contact in Autopilot.',
                'icon' => 'ph:user-plus',
            ],
            'autopilot_list_lists' => [
                'class' => AutopilotListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all lists in your Autopilot account.',
                'icon' => 'ph:list',
            ],
            'autopilot_get_list' => [
                'class' => AutopilotGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get details for a specific list.',
                'icon' => 'ph:list',
            ],
            'autopilot_list_journeys' => [
                'class' => AutopilotListJourneys::class,
                'type' => 'read',
                'name' => 'List Journeys',
                'description' => 'List all journeys in your Autopilot account.',
                'icon' => 'ph:path',
            ],
            'autopilot_get_current_user' => [
                'class' => AutopilotGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s account details.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/autopilot.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.autopilotapp.com/v1'],
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

            $service = new AutopilotService(
                apiKey: $creds->get('autopilot', 'api_key', '', $account),
                baseUrl: $creds->get('autopilot', 'url', 'https://api.autopilotapp.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AutopilotService::class));
    }
}
