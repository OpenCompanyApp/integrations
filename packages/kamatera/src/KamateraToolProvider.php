<?php

namespace OpenCompany\Integrations\Kamatera;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Kamatera\Tools\KamateraListServers;
use OpenCompany\Integrations\Kamatera\Tools\KamateraGetServer;
use OpenCompany\Integrations\Kamatera\Tools\KamateraCreateServer;
use OpenCompany\Integrations\Kamatera\Tools\KamateraListNetworks;
use OpenCompany\Integrations\Kamatera\Tools\KamateraListImages;
use OpenCompany\Integrations\Kamatera\Tools\KamateraListDatacenters;
use OpenCompany\Integrations\Kamatera\Tools\KamateraGetCurrentUser;

class KamateraToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'kamatera';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'servers, networks, images, datacenters',
            'description' => 'Cloud infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:kamatera',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Kamatera',
            'description' => 'Cloud infrastructure — servers, networks, images, and datacenters',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:kamatera',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.kamatera.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Kamatera API token',
                'hint' => 'Generate an API key in the Kamatera console under <strong>API Settings</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://cloudcli.kamatera.com/api',
                'hint' => 'Override only if using a custom Kamatera-compatible endpoint',
                'default' => 'https://cloudcli.kamatera.com/api',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://cloudcli.kamatera.com/api', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
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
                    'error' => "Could not reach Kamatera API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Kamatera API error ({$response->status()}): {$message}",
                ];
            }

            $account = $json['account'] ?? $json['user'] ?? [];
            $email = $account['email'] ?? $account['name'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Kamatera as {$email}.",
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
            'kamatera_list_servers' => [
                'class' => KamateraListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all cloud servers in the account.',
                'icon' => 'ph:servers',
            ],
            'kamatera_get_server' => [
                'class' => KamateraGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific cloud server.',
                'icon' => 'ph:server',
            ],
            'kamatera_create_server' => [
                'class' => KamateraCreateServer::class,
                'type' => 'write',
                'name' => 'Create Server',
                'description' => 'Create a new cloud server.',
                'icon' => 'ph:plus-circle',
            ],
            'kamatera_list_networks' => [
                'class' => KamateraListNetworks::class,
                'type' => 'read',
                'name' => 'List Networks',
                'description' => 'List all networks in the account.',
                'icon' => 'ph:wifi-high',
            ],
            'kamatera_list_images' => [
                'class' => KamateraListImages::class,
                'type' => 'read',
                'name' => 'List Images',
                'description' => 'List all available images for server creation.',
                'icon' => 'ph:hard-drives',
            ],
            'kamatera_list_datacenters' => [
                'class' => KamateraListDatacenters::class,
                'type' => 'read',
                'name' => 'List Datacenters',
                'description' => 'List all available datacenter locations.',
                'icon' => 'ph:buildings',
            ],
            'kamatera_get_current_user' => [
                'class' => KamateraGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/kamatera.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://cloudcli.kamatera.com/api'],
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

            $service = new KamateraService(
                accessToken: $creds->get('kamatera', 'access_token', '', $account),
                baseUrl: $creds->get('kamatera', 'url', 'https://cloudcli.kamatera.com/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(KamateraService::class));
    }
}
