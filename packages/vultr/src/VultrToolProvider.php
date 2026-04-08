<?php

namespace OpenCompany\Integrations\Vultr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vultr\Tools\VultrListInstances;
use OpenCompany\Integrations\Vultr\Tools\VultrGetInstance;
use OpenCompany\Integrations\Vultr\Tools\VultrListPlans;
use OpenCompany\Integrations\Vultr\Tools\VultrListRegions;
use OpenCompany\Integrations\Vultr\Tools\VultrListSnapshots;
use OpenCompany\Integrations\Vultr\Tools\VultrListSshKeys;
use OpenCompany\Integrations\Vultr\Tools\VultrGetCurrentUser;

class VultrToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vultr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'instances, plans, regions, snapshots, ssh keys',
            'description' => 'Cloud computing',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:vultr',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vultr',
            'description' => 'Cloud computing — instances, plans, regions, snapshots, and SSH keys',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:vultr',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.vultr.com/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Vultr API token',
                'hint' => 'Generate a personal access token in the Vultr control panel under <strong>Account → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.vultr.com/v2',
                'hint' => 'Override only if using a custom Vultr-compatible endpoint',
                'default' => 'https://api.vultr.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.vultr.com/v2', '/');

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
                    'error' => "Could not reach Vultr API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Vultr API error ({$response->status()}): {$message}",
                ];
            }

            $account = $json['account'] ?? [];
            $email = $account['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Vultr as {$email}.",
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
            'vultr_list_instances' => [
                'class' => VultrListInstances::class,
                'type' => 'read',
                'name' => 'List Instances',
                'description' => 'List all compute instances in the account.',
                'icon' => 'ph:server',
            ],
            'vultr_get_instance' => [
                'class' => VultrGetInstance::class,
                'type' => 'read',
                'name' => 'Get Instance',
                'description' => 'Get details for a specific compute instance.',
                'icon' => 'ph:server',
            ],
            'vultr_list_plans' => [
                'class' => VultrListPlans::class,
                'type' => 'read',
                'name' => 'List Plans',
                'description' => 'List all available hosting plans.',
                'icon' => 'ph:list-bullets',
            ],
            'vultr_list_regions' => [
                'class' => VultrListRegions::class,
                'type' => 'read',
                'name' => 'List Regions',
                'description' => 'List all available data center regions.',
                'icon' => 'ph:globe',
            ],
            'vultr_list_snapshots' => [
                'class' => VultrListSnapshots::class,
                'type' => 'read',
                'name' => 'List Snapshots',
                'description' => 'List all snapshots in the account.',
                'icon' => 'ph:camera',
            ],
            'vultr_list_ssh_keys' => [
                'class' => VultrListSshKeys::class,
                'type' => 'read',
                'name' => 'List SSH Keys',
                'description' => 'List all SSH keys in the account.',
                'icon' => 'ph:key',
            ],
            'vultr_get_current_user' => [
                'class' => VultrGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vultr.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vultr.com/v2'],
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

            $service = new VultrService(
                accessToken: $creds->get('vultr', 'access_token', '', $account),
                baseUrl: $creds->get('vultr', 'url', 'https://api.vultr.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(VultrService::class));
    }
}
