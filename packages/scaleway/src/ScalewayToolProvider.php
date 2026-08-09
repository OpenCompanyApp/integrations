<?php

namespace OpenCompany\Integrations\Scaleway;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayListServers;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayGetServer;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayListVolumes;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayListSnapshots;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayListSecurityGroups;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayListIps;
use OpenCompany\Integrations\Scaleway\Tools\ScalewayGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class ScalewayToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'scaleway';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Scaleway',
            'description' => 'Cloud infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:scaleway',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Scaleway',
            'description' => 'European cloud infrastructure — servers, volumes, snapshots, security groups, and flexible IPs',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:scaleway',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.scaleway.com/en/products/instance/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Scaleway API token',
                'hint' => 'Generate an API token in the Scaleway console under <strong>Credentials</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.scaleway.com/instance/v1/zones/fr-par-1',
                'hint' => 'Override only if using a different zone or custom endpoint',
                'default' => 'https://api.scaleway.com/instance/v1/zones/fr-par-1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.scaleway.com/instance/v1/zones/fr-par-1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Auth-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.scaleway.com/account/v2');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Scaleway API. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Scaleway API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Scaleway as {$email}.",
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
            'scaleway_list_servers' => [
                'class' => ScalewayListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all servers in the Scaleway zone.',
                'icon' => 'ph:server',
            ],
            'scaleway_get_server' => [
                'class' => ScalewayGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific server.',
                'icon' => 'ph:server',
            ],
            'scaleway_list_volumes' => [
                'class' => ScalewayListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List all block storage volumes in the zone.',
                'icon' => 'ph:hard-drives',
            ],
            'scaleway_list_snapshots' => [
                'class' => ScalewayListSnapshots::class,
                'type' => 'read',
                'name' => 'List Snapshots',
                'description' => 'List all volume snapshots in the zone.',
                'icon' => 'ph:camera',
            ],
            'scaleway_list_security_groups' => [
                'class' => ScalewayListSecurityGroups::class,
                'type' => 'read',
                'name' => 'List Security Groups',
                'description' => 'List all security groups (firewall rules) in the zone.',
                'icon' => 'ph:shield-check',
            ],
            'scaleway_list_ips' => [
                'class' => ScalewayListIps::class,
                'type' => 'read',
                'name' => 'List IPs',
                'description' => 'List all flexible IPs in the zone.',
                'icon' => 'ph:glob',
            ],
            'scaleway_get_current_user' => [
                'class' => ScalewayGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/scaleway.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.scaleway.com/instance/v1/zones/fr-par-1'],
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

            $service = new ScalewayService(
                accessToken: $creds->get('scaleway', 'access_token', '', $account),
                baseUrl: $creds->get('scaleway', 'url', 'https://api.scaleway.com/instance/v1/zones/fr-par-1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ScalewayService::class));
    }
}
