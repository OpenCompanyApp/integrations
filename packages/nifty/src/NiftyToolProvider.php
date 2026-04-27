<?php

namespace OpenCompany\Integrations\Nifty;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nifty\Tools\NiftyListProjects;
use OpenCompany\Integrations\Nifty\Tools\NiftyGetProject;
use OpenCompany\Integrations\Nifty\Tools\NiftyListTasks;
use OpenCompany\Integrations\Nifty\Tools\NiftyGetTask;
use OpenCompany\Integrations\Nifty\Tools\NiftyCreateTask;
use OpenCompany\Integrations\Nifty\Tools\NiftyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NiftyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'nifty';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, tasks, user',
            'description' => 'Project management',
            'icon' => 'ph:folder-open',
            'logo' => 'simple-icons:nifty',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Nifty',
            'description' => 'Project management and team collaboration platform',
            'icon' => 'ph:folder-open',
            'logo' => 'simple-icons:nifty',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.nifty.co/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Nifty access token',
                'hint' => 'Generate a personal access token in your Nifty account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.niftyco.com/v1',
                'hint' => 'The base URL for the Nifty API. Change only if using a custom endpoint.',
                'default' => 'https://api.niftyco.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.niftyco.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
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
                    'error' => "Could not reach Nifty API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed. Check your access token.",
                ];
            }

            $userName = ($json['name'] ?? $json['email'] ?? 'Unknown');

            return [
                'success' => true,
                'message' => "Connected to Nifty API as {$userName}.",
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
            'nifty_list_projects' => [
                'class' => NiftyListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in Nifty.',
                'icon' => 'ph:folder-open',
            ],
            'nifty_get_project' => [
                'class' => NiftyGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'nifty_list_tasks' => [
                'class' => NiftyListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'nifty_get_task' => [
                'class' => NiftyGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details of a specific task.',
                'icon' => 'ph:list-checks',
            ],
            'nifty_create_task' => [
                'class' => NiftyCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in a project.',
                'icon' => 'ph:plus-circle',
            ],
            'nifty_get_current_user' => [
                'class' => NiftyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/nifty.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.niftyco.com/v1'],
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

            $service = new NiftyService(
                accessToken: $creds->get('nifty', 'access_token', '', $account),
                baseUrl: $creds->get('nifty', 'url', 'https://api.niftyco.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(NiftyService::class));
    }
}
