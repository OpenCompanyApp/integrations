<?php

namespace OpenCompany\Integrations\Clockify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Clockify\Tools\ClockifyCreateProject;
use OpenCompany\Integrations\Clockify\Tools\ClockifyCreateTimeEntry;
use OpenCompany\Integrations\Clockify\Tools\ClockifyDeleteTimeEntry;
use OpenCompany\Integrations\Clockify\Tools\ClockifyGetCurrentUser;
use OpenCompany\Integrations\Clockify\Tools\ClockifyGetProject;
use OpenCompany\Integrations\Clockify\Tools\ClockifyGetTimeEntry;
use OpenCompany\Integrations\Clockify\Tools\ClockifyGetWorkspace;
use OpenCompany\Integrations\Clockify\Tools\ClockifyListProjects;
use OpenCompany\Integrations\Clockify\Tools\ClockifyListTasks;
use OpenCompany\Integrations\Clockify\Tools\ClockifyListTimeEntries;
use OpenCompany\Integrations\Clockify\Tools\ClockifyListWorkspaces;
use OpenCompany\Integrations\Clockify\Tools\ClockifyUpdateTimeEntry;

/**
 * Tool provider for the Clockify integration.
 *
 * Registers 12 tools covering workspaces, projects, time entries, tasks, and user info.
 * Implements ConfigurableIntegration for settings UI and credential management.
 */
class ClockifyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'clockify';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'workspaces, projects, time entries, tasks',
            'description' => 'Time tracking and project management',
            'icon' => 'ph:clock',
            'logo' => 'simple-icons:clockify',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Clockify',
            'description' => 'Free time tracking and project management',
            'icon' => 'ph:clock',
            'logo' => 'simple-icons:clockify',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://clockify.me/developers-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Clockify API key',
                'hint' => 'Generate an API key in your Clockify profile settings under "API"',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Api-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.clockify.me/api/v1/user');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            $user = $response->json();
            $name = trim(($user['name'] ?? '') . ' <' . ($user['email'] ?? '') . '>');

            return [
                'success' => true,
                'message' => "Connected to Clockify as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'clockify_list_workspaces' => [
                'class' => ClockifyListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all Clockify workspaces the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'clockify_get_workspace' => [
                'class' => ClockifyGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details for a single Clockify workspace.',
                'icon' => 'ph:buildings',
            ],
            'clockify_list_projects' => [
                'class' => ClockifyListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in a Clockify workspace.',
                'icon' => 'ph:folder',
            ],
            'clockify_get_project' => [
                'class' => ClockifyGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a single Clockify project.',
                'icon' => 'ph:folder',
            ],
            'clockify_create_project' => [
                'class' => ClockifyCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project in a Clockify workspace.',
                'icon' => 'ph:folder-plus',
            ],
            'clockify_list_time_entries' => [
                'class' => ClockifyListTimeEntries::class,
                'type' => 'read',
                'name' => 'List Time Entries',
                'description' => 'List time entries in a Clockify workspace, optionally filtered by date range or project.',
                'icon' => 'ph:timer',
            ],
            'clockify_get_time_entry' => [
                'class' => ClockifyGetTimeEntry::class,
                'type' => 'read',
                'name' => 'Get Time Entry',
                'description' => 'Get details for a single Clockify time entry.',
                'icon' => 'ph:timer',
            ],
            'clockify_create_time_entry' => [
                'class' => ClockifyCreateTimeEntry::class,
                'type' => 'write',
                'name' => 'Create Time Entry',
                'description' => 'Create a new time entry in a Clockify workspace.',
                'icon' => 'ph:timer',
            ],
            'clockify_update_time_entry' => [
                'class' => ClockifyUpdateTimeEntry::class,
                'type' => 'write',
                'name' => 'Update Time Entry',
                'description' => 'Update an existing Clockify time entry.',
                'icon' => 'ph:pencil-simple',
            ],
            'clockify_delete_time_entry' => [
                'class' => ClockifyDeleteTimeEntry::class,
                'type' => 'write',
                'name' => 'Delete Time Entry',
                'description' => 'Delete a Clockify time entry.',
                'icon' => 'ph:trash',
            ],
            'clockify_list_tasks' => [
                'class' => ClockifyListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks for a Clockify project.',
                'icon' => 'ph:list-checks',
            ],
            'clockify_get_current_user' => [
                'class' => ClockifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Clockify user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/clockify.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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

            $service = new ClockifyService(
                apiKey: $creds->get('clockify', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ClockifyService::class));
    }
}
