<?php

namespace OpenCompany\Integrations\Contabo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Contabo\Tools\ContaboGetCurrentUser;
use OpenCompany\Integrations\Contabo\Tools\ContaboGetInstance;
use OpenCompany\Integrations\Contabo\Tools\ContaboListImages;
use OpenCompany\Integrations\Contabo\Tools\ContaboListInstances;
use OpenCompany\Integrations\Contabo\Tools\ContaboListNetworks;
use OpenCompany\Integrations\Contabo\Tools\ContaboListSnapshots;
use OpenCompany\Integrations\Contabo\Tools\ContaboListSshKeys;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ContaboToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'contabo';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Contabo',
            'description' => 'Cloud VPS infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:contabo',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Contabo',
            'description' => 'Cloud VPS provider — compute instances, snapshots, custom images, private networks, and SSH keys',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:contabo',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.contabo.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Contabo API access token',
                'hint' => 'Generate an API access token in the Contabo Control Panel under <strong>API</strong> settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.contabo.com/v1',
                'hint' => 'Override only if using a custom Contabo-compatible endpoint',
                'default' => 'https://api.contabo.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.contabo.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/v1/users/current');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Contabo API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Contabo API error ({$response->status()}): {$message}",
                ];
            }

            $user = $json['data'] ?? $json;
            $email = $user['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Contabo as {$email}.",
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
            'contabo_list_instances' => [
                'class' => ContaboListInstances::class,
                'type' => 'read',
                'name' => 'List Instances',
                'description' => 'List all compute instances (VPS) in the Contabo account.',
                'icon' => 'ph:server',
            ],
            'contabo_get_instance' => [
                'class' => ContaboGetInstance::class,
                'type' => 'read',
                'name' => 'Get Instance',
                'description' => 'Get details for a specific compute instance (VPS).',
                'icon' => 'ph:server',
            ],
            'contabo_list_snapshots' => [
                'class' => ContaboListSnapshots::class,
                'type' => 'read',
                'name' => 'List Snapshots',
                'description' => 'List all snapshots in the Contabo account.',
                'icon' => 'ph:camera',
            ],
            'contabo_list_images' => [
                'class' => ContaboListImages::class,
                'type' => 'read',
                'name' => 'List Images',
                'description' => 'List all custom images in the Contabo account.',
                'icon' => 'ph:hard-drives',
            ],
            'contabo_list_networks' => [
                'class' => ContaboListNetworks::class,
                'type' => 'read',
                'name' => 'List Networks',
                'description' => 'List all private networks in the Contabo account.',
                'icon' => 'ph:network',
            ],
            'contabo_list_ssh_keys' => [
                'class' => ContaboListSshKeys::class,
                'type' => 'read',
                'name' => 'List SSH Keys',
                'description' => 'List all registered SSH keys in the Contabo account.',
                'icon' => 'ph:key',
            ],
            'contabo_get_current_user' => [
                'class' => ContaboGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Contabo account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/contabo.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.contabo.com/v1'],
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

            $service = new ContaboService(
                accessToken: $creds->get('contabo', 'access_token', '', $account),
                baseUrl: $creds->get('contabo', 'url', 'https://api.contabo.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ContaboService::class));
    }
}
