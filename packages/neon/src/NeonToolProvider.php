<?php

namespace OpenCompany\Integrations\Neon;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Neon\Tools\NeonCreateProject;
use OpenCompany\Integrations\Neon\Tools\NeonGetBranch;
use OpenCompany\Integrations\Neon\Tools\NeonGetCurrentUser;
use OpenCompany\Integrations\Neon\Tools\NeonGetProject;
use OpenCompany\Integrations\Neon\Tools\NeonListBranches;
use OpenCompany\Integrations\Neon\Tools\NeonListDatabases;
use OpenCompany\Integrations\Neon\Tools\NeonListProjects;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NeonToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'neon';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, branches, databases',
            'description' => 'Serverless Postgres',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:neon',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Neon',
            'description' => 'Neon — serverless Postgres with branching, autoscaling, and instant provisioning',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:neon',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://neon.tech/docs/api-reference',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Neon API key',
                'hint' => 'Generate an API key in the Neon Console under <strong>Account Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://console.neon.tech/api/v2',
                'hint' => 'Override only if using a custom Neon-compatible endpoint',
                'default' => 'https://console.neon.tech/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://console.neon.tech/api/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Neon API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Neon API error ({$response->status()}): {$message}",
                ];
            }

            $user = $json['user'] ?? $json;
            $email = is_array($user) ? ($user['email'] ?? 'unknown') : 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Neon as {$email}.",
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
            'neon_list_projects' => [
                'class' => NeonListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Neon projects in the organization.',
                'icon' => 'ph:folder',
            ],
            'neon_get_project' => [
                'class' => NeonGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Neon project.',
                'icon' => 'ph:folder-open',
            ],
            'neon_create_project' => [
                'class' => NeonCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new Neon project.',
                'icon' => 'ph:plus-circle',
            ],
            'neon_list_branches' => [
                'class' => NeonListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List branches in a Neon project.',
                'icon' => 'ph:git-branch',
            ],
            'neon_get_branch' => [
                'class' => NeonGetBranch::class,
                'type' => 'read',
                'name' => 'Get Branch',
                'description' => 'Get details for a specific branch in a Neon project.',
                'icon' => 'ph:git-branch',
            ],
            'neon_list_databases' => [
                'class' => NeonListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List databases in a Neon project branch.',
                'icon' => 'ph:database',
            ],
            'neon_get_current_user' => [
                'class' => NeonGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/neon.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://console.neon.tech/api/v2'],
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

            $service = new NeonService(
                accessToken: $creds->get('neon', 'access_token', '', $account),
                baseUrl: $creds->get('neon', 'url', 'https://console.neon.tech/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(NeonService::class));
    }
}
