<?php

namespace OpenCompany\Integrations\Ionos;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ionos\Tools\IonosListServers;
use OpenCompany\Integrations\Ionos\Tools\IonosGetServer;
use OpenCompany\Integrations\Ionos\Tools\IonosListVolumes;
use OpenCompany\Integrations\Ionos\Tools\IonosListLans;
use OpenCompany\Integrations\Ionos\Tools\IonosListNics;
use OpenCompany\Integrations\Ionos\Tools\IonosListImages;
use OpenCompany\Integrations\Ionos\Tools\IonosGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class IonosToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'ionos';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'servers, volumes, LANs, NICs, images',
            'description' => 'Cloud infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:ionos',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'IONOS Cloud',
            'description' => 'IONOS Cloud infrastructure — servers, volumes, LANs, NICs, and images',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:ionos',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.ionos.com/docs/cloud/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your IONOS Cloud API token',
                'hint' => 'Generate an API token in the IONOS Cloud Console under <strong>API Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ionos.com/cloudapi/v6',
                'hint' => 'Override only if using a custom IONOS-compatible endpoint',
                'default' => 'https://api.ionos.com/cloudapi/v6',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ionos.com/cloudapi/v6', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/um/users/own');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach IONOS API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "IONOS API error ({$response->status()}): {$message}",
                ];
            }

            $user = $json['properties'] ?? $json;
            $email = $user['email'] ?? $user['firstname'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to IONOS Cloud as {$email}.",
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
            'ionos_list_servers' => [
                'class' => IonosListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all servers in the IONOS Cloud account.',
                'icon' => 'ph:server',
            ],
            'ionos_get_server' => [
                'class' => IonosGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific server.',
                'icon' => 'ph:server',
            ],
            'ionos_list_volumes' => [
                'class' => IonosListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List all block storage volumes.',
                'icon' => 'ph:database',
            ],
            'ionos_list_lans' => [
                'class' => IonosListLans::class,
                'type' => 'read',
                'name' => 'List LANs',
                'description' => 'List all local area networks.',
                'icon' => 'ph:wifi-high',
            ],
            'ionos_list_nics' => [
                'class' => IonosListNics::class,
                'type' => 'read',
                'name' => 'List NICs',
                'description' => 'List all network interface cards.',
                'icon' => 'ph:ethernet',
            ],
            'ionos_list_images' => [
                'class' => IonosListImages::class,
                'type' => 'read',
                'name' => 'List Images',
                'description' => 'List all available images.',
                'icon' => 'ph:hard-drives',
            ],
            'ionos_get_current_user' => [
                'class' => IonosGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ionos.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ionos.com/cloudapi/v6'],
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

            $service = new IonosService(
                accessToken: $creds->get('ionos', 'access_token', '', $account),
                baseUrl: $creds->get('ionos', 'url', 'https://api.ionos.com/cloudapi/v6', $account),
            );

            return new $class($service);
        }

        return new $class(app(IonosService::class));
    }
}
