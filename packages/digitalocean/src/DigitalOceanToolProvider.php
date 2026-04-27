<?php

namespace OpenCompany\Integrations\DigitalOcean;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanCreateDroplet;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanDeleteDroplet;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanGetCurrentUser;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanGetDroplet;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanGetDomain;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListDomains;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListDroplets;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListKubernetes;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanListSpaces;
use OpenCompany\Integrations\DigitalOcean\Tools\DigitalOceanRebootDroplet;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DigitalOceanToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'digitalocean';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'droplets, domains, spaces, k8s',
            'description' => 'Cloud infrastructure',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:digitalocean',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'DigitalOcean',
            'description' => 'Cloud infrastructure — droplets, domains, Spaces storage, and Kubernetes',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:digitalocean',
            'category' => 'cloud',
            'badge' => 'verified',
            'docs_url' => 'https://docs.digitalocean.com/reference/api/api-reference/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your DigitalOcean API token',
                'hint' => 'Generate a personal access token in the DigitalOcean control panel under <strong>API → Tokens/Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.digitalocean.com/v2',
                'hint' => 'Override only if using a custom DigitalOcean-compatible endpoint',
                'default' => 'https://api.digitalocean.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.digitalocean.com/v2', '/');

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
                    'error' => "Could not reach DigitalOcean API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "DigitalOcean API error ({$response->status()}): {$message}",
                ];
            }

            $account = $json['account'] ?? [];
            $email = $account['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to DigitalOcean as {$email}.",
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
            'digitalocean_list_droplets' => [
                'class' => DigitalOceanListDroplets::class,
                'type' => 'read',
                'name' => 'List Droplets',
                'description' => 'List all droplets (virtual machines) in the account.',
                'icon' => 'ph:server',
            ],
            'digitalocean_get_droplet' => [
                'class' => DigitalOceanGetDroplet::class,
                'type' => 'read',
                'name' => 'Get Droplet',
                'description' => 'Get details for a specific droplet.',
                'icon' => 'ph:server',
            ],
            'digitalocean_create_droplet' => [
                'class' => DigitalOceanCreateDroplet::class,
                'type' => 'write',
                'name' => 'Create Droplet',
                'description' => 'Create a new droplet (virtual machine).',
                'icon' => 'ph:plus-circle',
            ],
            'digitalocean_delete_droplet' => [
                'class' => DigitalOceanDeleteDroplet::class,
                'type' => 'write',
                'name' => 'Delete Droplet',
                'description' => 'Permanently delete a droplet.',
                'icon' => 'ph:trash',
            ],
            'digitalocean_reboot_droplet' => [
                'class' => DigitalOceanRebootDroplet::class,
                'type' => 'write',
                'name' => 'Reboot Droplet',
                'description' => 'Reboot a droplet.',
                'icon' => 'ph:arrow-clockwise',
            ],
            'digitalocean_list_domains' => [
                'class' => DigitalOceanListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all DNS domains in the account.',
                'icon' => 'ph:globe',
            ],
            'digitalocean_get_domain' => [
                'class' => DigitalOceanGetDomain::class,
                'type' => 'read',
                'name' => 'Get Domain',
                'description' => 'Get details for a specific DNS domain.',
                'icon' => 'ph:globe',
            ],
            'digitalocean_list_spaces' => [
                'class' => DigitalOceanListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'List Spaces (object storage buckets).',
                'icon' => 'ph:database',
            ],
            'digitalocean_list_kubernetes' => [
                'class' => DigitalOceanListKubernetes::class,
                'type' => 'read',
                'name' => 'List Kubernetes Clusters',
                'description' => 'List Kubernetes clusters.',
                'icon' => 'ph:cube',
            ],
            'digitalocean_get_current_user' => [
                'class' => DigitalOceanGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/digitalocean.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.digitalocean.com/v2'],
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

            $service = new DigitalOceanService(
                accessToken: $creds->get('digitalocean', 'access_token', '', $account),
                baseUrl: $creds->get('digitalocean', 'url', 'https://api.digitalocean.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(DigitalOceanService::class));
    }
}
