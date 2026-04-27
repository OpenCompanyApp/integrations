<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCreateTask;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetCurrentUser;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetProject;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetTask;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListProjects;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListTasks;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListTimers;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Teamwork tools and provides integration metadata.
 *
 * Exposes 7 tools covering projects, tasks, timers, and user management
 * via the ToolProvider contract.
 */
class TeamworkToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'teamwork';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, tasks, timers, and team management',
            'description' => 'Project Management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:teamwork',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Teamwork',
            'description' => 'Projects, tasks, timers, and team management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:teamwork',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.teamwork.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Your Teamwork API token',
                'hint' => 'Generate at <code>https://your-site.teamwork.com/#/settings/apikeys</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Teamwork connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'API Token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.teamwork.com/v1/me.json');

            if ($response->successful()) {
                $data = $response->json('person') ?? $response->json() ?? [];
                $name = ($data['firstName'] ?? '') . ' ' . ($data['lastName'] ?? '');
                $name = trim($name) ?: 'Unknown';
                $email = $data['emailAddress'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Teamwork as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Teamwork API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Projects
            'teamwork_list_projects' => [
                'class' => TeamworkListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in Teamwork with optional filters.',
                'icon' => 'ph:folders',
            ],
            'teamwork_get_project' => [
                'class' => TeamworkGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a Teamwork project.',
                'icon' => 'ph:folder-open',
            ],
            // Tasks
            'teamwork_list_tasks' => [
                'class' => TeamworkListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Teamwork with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'teamwork_get_task' => [
                'class' => TeamworkGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about a Teamwork task.',
                'icon' => 'ph:note',
            ],
            'teamwork_create_task' => [
                'class' => TeamworkCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Teamwork.',
                'icon' => 'ph:plus-circle',
            ],
            // Timers
            'teamwork_list_timers' => [
                'class' => TeamworkListTimers::class,
                'type' => 'read',
                'name' => 'List Timers',
                'description' => 'List time timers for the authenticated user in Teamwork.',
                'icon' => 'ph:timer',
            ],
            // Users
            'teamwork_get_current_user' => [
                'class' => TeamworkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Teamwork user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/teamwork.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TeamworkService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): TeamworkService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TeamworkService(
                apiToken: $creds->get('teamwork', 'api_token', '', $account),
            );
        }

        return app(TeamworkService::class);
    }
}
