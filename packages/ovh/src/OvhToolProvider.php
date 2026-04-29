<?php

namespace OpenCompany\Integrations\Ovh;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ovh\Tools\OvhListServers;
use OpenCompany\Integrations\Ovh\Tools\OvhGetServer;
use OpenCompany\Integrations\Ovh\Tools\OvhListDomains;
use OpenCompany\Integrations\Ovh\Tools\OvhListVps;
use OpenCompany\Integrations\Ovh\Tools\OvhListIp;
use OpenCompany\Integrations\Ovh\Tools\OvhListProjects;
use OpenCompany\Integrations\Ovh\Tools\OvhGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class OvhToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'ovh';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OVHcloud',
            'description' => 'Cloud infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:ovh',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OVHcloud',
            'description' => 'European cloud infrastructure — dedicated servers, domains, VPS, IP addresses, and public cloud projects',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:ovh',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://api.ovh.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your OVH API Bearer token',
                'hint' => 'Generate a token in the <strong>OVH API console</strong> at api.ovh.com',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://eu.api.ovh.com/1.0',
                'hint' => 'Override only if using a different OVH API endpoint (e.g. ca.api.ovh.com)',
                'default' => 'https://eu.api.ovh.com/1.0',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://eu.api.ovh.com/1.0', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach OVH API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "OVH API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';
            $nichandle = $json['nichandle'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to OVH as {$nichandle} ({$email}).",
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
            'ovh_list_servers' => [
                'class' => OvhListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all dedicated servers in the OVH account.',
                'icon' => 'ph:server',
            ],
            'ovh_get_server' => [
                'class' => OvhGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific dedicated server.',
                'icon' => 'ph:server',
            ],
            'ovh_list_domains' => [
                'class' => OvhListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains in the OVH account.',
                'icon' => 'ph:globe',
            ],
            'ovh_list_vps' => [
                'class' => OvhListVps::class,
                'type' => 'read',
                'name' => 'List VPS',
                'description' => 'List all VPS instances in the OVH account.',
                'icon' => 'ph:cube',
            ],
            'ovh_list_ip' => [
                'class' => OvhListIp::class,
                'type' => 'read',
                'name' => 'List IP Addresses',
                'description' => 'List all IP addresses in the OVH account.',
                'icon' => 'ph:wifi-ip',
            ],
            'ovh_list_projects' => [
                'class' => OvhListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all public cloud projects.',
                'icon' => 'ph:folder',
            ],
            'ovh_get_current_user' => [
                'class' => OvhGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated OVH account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ovh.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://eu.api.ovh.com/1.0'],
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

            $service = new OvhService(
                accessToken: $creds->get('ovh', 'access_token', '', $account),
                baseUrl: $creds->get('ovh', 'url', 'https://eu.api.ovh.com/1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(OvhService::class));
    }
}
