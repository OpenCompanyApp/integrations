<?php

namespace OpenCompany\Integrations\Hetzner;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Hetzner\Tools\HetznerListServers;
use OpenCompany\Integrations\Hetzner\Tools\HetznerGetServer;
use OpenCompany\Integrations\Hetzner\Tools\HetznerCreateServer;
use OpenCompany\Integrations\Hetzner\Tools\HetznerListVolumes;
use OpenCompany\Integrations\Hetzner\Tools\HetznerListNetworks;
use OpenCompany\Integrations\Hetzner\Tools\HetznerListSshKeys;
use OpenCompany\Integrations\Hetzner\Tools\HetznerGetCurrentUser;

class HetznerToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'hetzner';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'servers, volumes, networks',
            'description' => 'Cloud infrastructure management',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:hetzner',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Hetzner Cloud',
            'description' => 'Cloud infrastructure platform for servers, volumes, networks, and SSH keys',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:hetzner',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.hetzner.cloud/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Hetzner Cloud API token',
                'hint' => 'Generate an API token from your Hetzner Cloud Console under "Security > API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.hetzner.cloud/v1',
                'hint' => 'Use <code>https://api.hetzner.cloud/v1</code> for the default API, or a custom endpoint',
                'default' => 'https://api.hetzner.cloud/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.hetzner.cloud/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Hetzner Cloud API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Hetzner Cloud API at {$baseUrl}.",
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
            'hetzner_list_servers' => [
                'class' => HetznerListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List Hetzner Cloud servers with optional pagination.',
                'icon' => 'ph:servers',
            ],
            'hetzner_get_server' => [
                'class' => HetznerGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific Hetzner Cloud server.',
                'icon' => 'ph:servers',
            ],
            'hetzner_create_server' => [
                'class' => HetznerCreateServer::class,
                'type' => 'write',
                'name' => 'Create Server',
                'description' => 'Create a new Hetzner Cloud server.',
                'icon' => 'ph:plus-circle',
            ],
            'hetzner_list_volumes' => [
                'class' => HetznerListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List Hetzner Cloud volumes with optional pagination.',
                'icon' => 'ph:hard-drives',
            ],
            'hetzner_list_networks' => [
                'class' => HetznerListNetworks::class,
                'type' => 'read',
                'name' => 'List Networks',
                'description' => 'List Hetzner Cloud networks with optional pagination.',
                'icon' => 'ph:network',
            ],
            'hetzner_list_ssh_keys' => [
                'class' => HetznerListSshKeys::class,
                'type' => 'read',
                'name' => 'List SSH Keys',
                'description' => 'List Hetzner Cloud SSH keys with optional pagination.',
                'icon' => 'ph:key',
            ],
            'hetzner_get_current_user' => [
                'class' => HetznerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/hetzner.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.hetzner.cloud/v1'],
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

            $service = new HetznerService(
                accessToken: $creds->get('hetzner', 'access_token', '', $account),
                baseUrl: $creds->get('hetzner', 'url', 'https://api.hetzner.cloud/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(HetznerService::class));
    }
}
