<?php

namespace OpenCompany\Integrations\Upcloud;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudListServers;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudGetServer;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudListStorages;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudListNetworks;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudListIps;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudListZones;
use OpenCompany\Integrations\Upcloud\Tools\UpcloudGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class UpcloudToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'upcloud';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'UpCloud',
            'description' => 'Cloud hosting management',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:upcloud',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'UpCloud',
            'description' => 'Cloud hosting platform for servers, storages, networks, and IPs',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:upcloud',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.upcloud.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your UpCloud API token',
                'hint' => 'Generate an API token from your UpCloud Hub under "Users" → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.upcloud.com/1.3',
                'hint' => 'Use <code>https://api.upcloud.com/1.3</code> for the default API, or a custom endpoint',
                'default' => 'https://api.upcloud.com/1.3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.upcloud.com/1.3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach UpCloud API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to UpCloud API at {$baseUrl}.",
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
            'upcloud_list_servers' => [
                'class' => UpcloudListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all cloud servers on the UpCloud account.',
                'icon' => 'ph:servers',
            ],
            'upcloud_get_server' => [
                'class' => UpcloudGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific UpCloud server.',
                'icon' => 'ph:servers',
            ],
            'upcloud_list_storages' => [
                'class' => UpcloudListStorages::class,
                'type' => 'read',
                'name' => 'List Storages',
                'description' => 'List storage devices on the UpCloud account.',
                'icon' => 'ph:hard-drives',
            ],
            'upcloud_list_networks' => [
                'class' => UpcloudListNetworks::class,
                'type' => 'read',
                'name' => 'List Networks',
                'description' => 'List private networks on the UpCloud account.',
                'icon' => 'ph:network',
            ],
            'upcloud_list_ips' => [
                'class' => UpcloudListIps::class,
                'type' => 'read',
                'name' => 'List IPs',
                'description' => 'List IP addresses on the UpCloud account.',
                'icon' => 'ph:ip-address',
            ],
            'upcloud_list_zones' => [
                'class' => UpcloudListZones::class,
                'type' => 'read',
                'name' => 'List Zones',
                'description' => 'List available UpCloud zones (data centers).',
                'icon' => 'ph:globe',
            ],
            'upcloud_get_current_user' => [
                'class' => UpcloudGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/upcloud.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.upcloud.com/1.3'],
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

            $service = new UpcloudService(
                accessToken: $creds->get('upcloud', 'access_token', '', $account),
                baseUrl: $creds->get('upcloud', 'url', 'https://api.upcloud.com/1.3', $account),
            );

            return new $class($service);
        }

        return new $class(app(UpcloudService::class));
    }
}
