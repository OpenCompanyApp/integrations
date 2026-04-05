<?php

namespace OpenCompany\Integrations\Teamwork;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCompleteTask;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCreateProject;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCreateTask;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkCreateTimeEntry;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetCurrentUser;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetProject;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetTask;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkGetTeam;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListProjects;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListTasks;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListTeams;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkListTimeEntries;
use OpenCompany\Integrations\Teamwork\Tools\TeamworkUpdateTask;

/**
 * Teamwork tool provider.
 *
 * Registers 13 tools for interacting with the Teamwork Projects API v3.
 * Supports multi-account configuration via ConfigurableIntegration.
 */
class TeamworkToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Machine name for the integration.
     */
    public function appName(): string
    {
        return 'teamwork';
    }

    /**
     * Short metadata shown in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label'       => 'projects, tasks, teams, time',
            'description' => 'Project management',
            'icon'        => 'ph:folders',
            'logo'        => 'simple-icons:teamwork',
        ];
    }

    /**
     * Metadata shown on the integrations settings page.
     */
    public function integrationMeta(): array
    {
        return [
            'name'        => 'Teamwork',
            'description' => 'Project management, task tracking, and time logging',
            'icon'        => 'ph:folders',
            'logo'        => 'simple-icons:teamwork',
            'category'    => 'project-management',
            'badge'       => 'verified',
            'docs_url'    => 'https://developer.teamwork.com/projects',
        ];
    }

    /**
     * Configuration schema for the integration settings UI.
     *
     * @return array<int, array{key: string, type: string, label: string, ...}>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'api_key',
                'type'        => 'secret',
                'label'       => 'API Key',
                'placeholder' => 'Enter your Teamwork API key',
                'hint'        => 'Generate an API key in Teamwork under Settings → API Keys',
                'required'    => true,
            ],
            [
                'key'         => 'hostname',
                'type'        => 'url',
                'label'       => 'Hostname',
                'placeholder' => 'myteam.teamwork.com',
                'hint'        => 'Your Teamwork installation hostname (e.g., <code>myteam.teamwork.com</code>)',
                'required'    => true,
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param array $config Configuration values (api_key, hostname).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey   = $config['api_key'] ?? '';
        $hostname = rtrim($config['hostname'] ?? '', '/');

        if (empty($apiKey) || empty($hostname)) {
            return ['success' => false, 'error' => 'API key and hostname are required.'];
        }

        $host = $hostname;
        if (!str_starts_with($host, 'http://') && !str_starts_with($host, 'https://')) {
            $host = 'https://' . $host;
        }
        $url = rtrim($host, '/') . '/projects/api/v3/me';

        try {
            $response = Http::withBasicAuth($apiKey, 'X')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($url);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error'   => "Could not reach Teamwork API at {$hostname}. Check the hostname.",
                ];
            }

            $userName = $json['person']['firstName'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to Teamwork as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for configuration values.
     */
    public function validationRules(): array
    {
        return [
            'api_key'  => 'nullable|string',
            'hostname' => 'nullable|string',
        ];
    }

    /**
     * Register all Teamwork tools.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'teamwork_list_projects' => [
                'class'       => TeamworkListProjects::class,
                'type'        => 'read',
                'name'        => 'List Projects',
                'description' => 'List projects in Teamwork.',
                'icon'        => 'ph:folder',
            ],
            'teamwork_get_project' => [
                'class'       => TeamworkGetProject::class,
                'type'        => 'read',
                'name'        => 'Get Project',
                'description' => 'Get details for a single project.',
                'icon'        => 'ph:folder-open',
            ],
            'teamwork_create_project' => [
                'class'       => TeamworkCreateProject::class,
                'type'        => 'write',
                'name'        => 'Create Project',
                'description' => 'Create a new project.',
                'icon'        => 'ph:folder-plus',
            ],
            'teamwork_list_tasks' => [
                'class'       => TeamworkListTasks::class,
                'type'        => 'read',
                'name'        => 'List Tasks',
                'description' => 'List tasks in a project.',
                'icon'        => 'ph:list-checks',
            ],
            'teamwork_get_task' => [
                'class'       => TeamworkGetTask::class,
                'type'        => 'read',
                'name'        => 'Get Task',
                'description' => 'Get details for a single task.',
                'icon'        => 'ph:check-square',
            ],
            'teamwork_create_task' => [
                'class'       => TeamworkCreateTask::class,
                'type'        => 'write',
                'name'        => 'Create Task',
                'description' => 'Create a new task in a project.',
                'icon'        => 'ph:plus-square',
            ],
            'teamwork_update_task' => [
                'class'       => TeamworkUpdateTask::class,
                'type'        => 'write',
                'name'        => 'Update Task',
                'description' => 'Update an existing task.',
                'icon'        => 'ph:pencil-square',
            ],
            'teamwork_complete_task' => [
                'class'       => TeamworkCompleteTask::class,
                'type'        => 'write',
                'name'        => 'Complete Task',
                'description' => 'Mark a task as complete.',
                'icon'        => 'ph:check-circle',
            ],
            'teamwork_list_teams' => [
                'class'       => TeamworkListTeams::class,
                'type'        => 'read',
                'name'        => 'List Teams',
                'description' => 'List teams.',
                'icon'        => 'ph:users-three',
            ],
            'teamwork_get_team' => [
                'class'       => TeamworkGetTeam::class,
                'type'        => 'read',
                'name'        => 'Get Team',
                'description' => 'Get details for a single team.',
                'icon'        => 'ph:users',
            ],
            'teamwork_list_time_entries' => [
                'class'       => TeamworkListTimeEntries::class,
                'type'        => 'read',
                'name'        => 'List Time Entries',
                'description' => 'List time entries for a project.',
                'icon'        => 'ph:clock',
            ],
            'teamwork_create_time_entry' => [
                'class'       => TeamworkCreateTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Create Time Entry',
                'description' => 'Log time against a project.',
                'icon'        => 'ph:clock-countdown',
            ],
            'teamwork_get_current_user' => [
                'class'       => TeamworkGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API documentation markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/teamwork.md';
    }

    /**
     * Credential fields for multi-account setup.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Hostname', 'required' => true],
        ];
    }

    /**
     * Confirm this is a full integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param class-string<Tool> $class   Tool class to instantiate.
     * @param array              $context Context with optional 'account' key for multi-account.
     * @return Tool
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new TeamworkService(
                apiKey:   $creds->get('teamwork', 'api_key', '', $account),
                hostname: $creds->get('teamwork', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TeamworkService::class));
    }
}
