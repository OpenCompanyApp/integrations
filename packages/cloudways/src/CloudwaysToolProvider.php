<?php

namespace OpenCompany\Integrations\Cloudways;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysListServers;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysGetServer;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysListApps;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysGetApp;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysListDomains;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysListProjects;
use OpenCompany\Integrations\Cloudways\Tools\CloudwaysGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CloudwaysToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'cloudways';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'servers, apps, domains, projects',
            'description' => 'Managed hosting',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudways',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Cloudways',
            'description' => 'Managed hosting — servers, applications, domains, and projects',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:cloudways',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.cloudways.com/en/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Cloudways API key',
                'hint' => 'Generate an API key in the Cloudways console under <strong>API → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cloudways.com/api/v1',
                'hint' => 'Override only if using a custom Cloudways-compatible endpoint',
                'default' => 'https://api.cloudways.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cloudways.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided'];
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
                    'error' => "Could not reach Cloudways API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $json['error'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Cloudways API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? ($json['me']['email'] ?? 'unknown');

            return [
                'success' => true,
                'message' => "Connected to Cloudways as {$email}.",
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
            'cloudways_list_servers' => [
                'class' => CloudwaysListServers::class,
                'type' => 'read',
                'name' => 'List Servers',
                'description' => 'List all servers in the Cloudways account.',
                'icon' => 'ph:server',
            ],
            'cloudways_get_server' => [
                'class' => CloudwaysGetServer::class,
                'type' => 'read',
                'name' => 'Get Server',
                'description' => 'Get details for a specific server.',
                'icon' => 'ph:server',
            ],
            'cloudways_list_apps' => [
                'class' => CloudwaysListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all applications across all servers.',
                'icon' => 'ph:app-window',
            ],
            'cloudways_get_app' => [
                'class' => CloudwaysGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details for a specific application.',
                'icon' => 'ph:app-window',
            ],
            'cloudways_list_domains' => [
                'class' => CloudwaysListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List domains for a specific application.',
                'icon' => 'ph:globe',
            ],
            'cloudways_list_projects' => [
                'class' => CloudwaysListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in the account.',
                'icon' => 'ph:folder',
            ],
            'cloudways_get_current_user' => [
                'class' => CloudwaysGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cloudways.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cloudways.com/api/v1'],
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

            $service = new CloudwaysService(
                accessToken: $creds->get('cloudways', 'access_token', '', $account),
                baseUrl: $creds->get('cloudways', 'url', 'https://api.cloudways.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(CloudwaysService::class));
    }
}
