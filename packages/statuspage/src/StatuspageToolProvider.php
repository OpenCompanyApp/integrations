<?php

namespace OpenCompany\Integrations\Statuspage;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageCreateIncident;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageGetCurrentUser;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListComponents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageListIncidents;
use OpenCompany\Integrations\Statuspage\Tools\StatuspageUpdateIncident;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class StatuspageToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'statuspage';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'incidents, components, status',
            'description' => 'Service status and incident management',
            'icon' => 'ph:signal',
            'logo' => 'simple-icons:atlassian',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Atlassian Statuspage',
            'description' => 'Service status and incident management with Atlassian Statuspage',
            'icon' => 'ph:signal',
            'logo' => 'simple-icons:atlassian',
            'category' => 'monitoring',
            'badge' => 'verified',
            'docs_url' => 'https://developer.statuspage.io/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Statuspage API key',
                'hint' => 'Generate an API key in your Statuspage account settings under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'page_id',
                'type' => 'string',
                'label' => 'Page ID',
                'placeholder' => 'e.g. q3y9xn5p4ckt',
                'hint' => 'Find your Page ID in Statuspage under "Page Settings" or the URL of your status page',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.statuspage.io/v1',
                'hint' => 'Use the default Atlassian cloud URL, or your self-hosted Statuspage API URL',
                'default' => 'https://api.statuspage.io/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.statuspage.io/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $email = $user['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Statuspage API as {$email}.",
                ];
            }

            return [
                'success' => false,
                'error' => "Statuspage API returned HTTP {$response->status()}. Check your API key.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'page_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'statuspage_list_incidents' => [
                'class' => StatuspageListIncidents::class,
                'type' => 'read',
                'name' => 'List Incidents',
                'description' => 'List all incidents for your Statuspage.',
                'icon' => 'ph:list-bullets',
            ],
            'statuspage_create_incident' => [
                'class' => StatuspageCreateIncident::class,
                'type' => 'write',
                'name' => 'Create Incident',
                'description' => 'Create a new incident on your Statuspage.',
                'icon' => 'ph:warning-circle',
            ],
            'statuspage_update_incident' => [
                'class' => StatuspageUpdateIncident::class,
                'type' => 'write',
                'name' => 'Update Incident',
                'description' => 'Update an existing incident on your Statuspage.',
                'icon' => 'ph:pencil-simple',
            ],
            'statuspage_list_components' => [
                'class' => StatuspageListComponents::class,
                'type' => 'read',
                'name' => 'List Components',
                'description' => 'List all components on your Statuspage.',
                'icon' => 'ph:squares-four',
            ],
            'statuspage_get_current_user' => [
                'class' => StatuspageGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Statuspage user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/statuspage.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'page_id', 'type' => 'string', 'label' => 'Page ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.statuspage.io/v1'],
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

            $service = new StatuspageService(
                apiKey: $creds->get('statuspage', 'api_key', '', $account),
                pageId: $creds->get('statuspage', 'page_id', '', $account),
                baseUrl: $creds->get('statuspage', 'url', 'https://api.statuspage.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(StatuspageService::class));
    }
}
