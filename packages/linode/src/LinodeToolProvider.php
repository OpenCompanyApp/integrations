<?php

namespace OpenCompany\Integrations\Linode;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Linode\Tools\LinodeListInstances;
use OpenCompany\Integrations\Linode\Tools\LinodeGetInstance;
use OpenCompany\Integrations\Linode\Tools\LinodeListVolumes;
use OpenCompany\Integrations\Linode\Tools\LinodeListDomains;
use OpenCompany\Integrations\Linode\Tools\LinodeGetDomain;
use OpenCompany\Integrations\Linode\Tools\LinodeListStackscripts;
use OpenCompany\Integrations\Linode\Tools\LinodeGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class LinodeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'linode';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'instances, volumes, domains, stackscripts',
            'description' => 'Cloud computing',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:linode',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Linode',
            'description' => 'Akamai cloud computing — Linode instances, volumes, domains, and StackScripts',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:linode',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://techdocs.akamai.com/linode-api/reference/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Linode API token',
                'hint' => 'Generate a personal access token in the Linode Cloud Manager under <strong>Profile → API Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.linode.com/v4',
                'hint' => 'Override only if using a custom Linode-compatible endpoint',
                'default' => 'https://api.linode.com/v4',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.linode.com/v4', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/profile');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Linode API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Linode API error ({$response->status()}): {$message}",
                ];
            }

            $username = $json['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Linode as {$username}.",
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
            'linode_list_instances' => [
                'class' => LinodeListInstances::class,
                'type' => 'read',
                'name' => 'List Instances',
                'description' => 'List all Linode instances (virtual machines) in the account.',
                'icon' => 'ph:server',
            ],
            'linode_get_instance' => [
                'class' => LinodeGetInstance::class,
                'type' => 'read',
                'name' => 'Get Instance',
                'description' => 'Get details for a specific Linode instance.',
                'icon' => 'ph:server',
            ],
            'linode_list_volumes' => [
                'class' => LinodeListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List all block storage volumes in the account.',
                'icon' => 'ph:hard-drives',
            ],
            'linode_list_domains' => [
                'class' => LinodeListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all DNS domains in the account.',
                'icon' => 'ph:globe',
            ],
            'linode_get_domain' => [
                'class' => LinodeGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details for a specific DNS domain.',
                'icon' => 'ph:globe',
            ],
            'linode_list_stackscripts' => [
                'class' => LinodeListStackscripts::class,
                'type' => 'read',
                'name' => 'List StackScripts',
                'description' => 'List all StackScripts (reusable deployment scripts).',
                'icon' => 'ph:code',
            ],
            'linode_get_current_user' => [
                'class' => LinodeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user profile information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/linode.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.linode.com/v4'],
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

            $service = new LinodeService(
                accessToken: $creds->get('linode', 'access_token', '', $account),
                baseUrl: $creds->get('linode', 'url', 'https://api.linode.com/v4', $account),
            );

            return new $class($service);
        }

        return new $class(app(LinodeService::class));
    }
}
