<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetCurrentUser;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistListLabels;
use OpenCompany\Integrations\Todoist\Tools\TodoistListProjects;
use OpenCompany\Integrations\Todoist\Tools\TodoistListTasks;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TodoistToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string { return 'todoist'; }

    public function appMeta(): array
    {
        return [
            'label' => 'Todoist',
            'description' => 'Task Management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:todoist',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Todoist',
            'description' => 'Tasks, projects, labels, and user management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:todoist',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.todoist.com/rest/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Your Todoist API Token',
                'hint' => 'Find your API token at <code>https://todoist.com/app/settings/integrations/developer</code> under "API token".',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'API Token is required.'];
        }
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.todoist.com/rest/v2/user');

            if ($response->successful()) {
                $data = $response->json() ?? [];
                $name = $data['full_name'] ?? 'Unknown';
                $email = $data['email'] ?? '';
                return ['success' => true, 'message' => "Connected to Todoist as {$name}" . ($email ? " ({$email})" : '') . '.'];
            }
            return ['success' => false, 'error' => 'Todoist API error (' . $response->status() . '): ' . $response->body()];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'todoist_list_tasks' => [
                'class' => TodoistListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Todoist with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'todoist_get_task' => [
                'class' => TodoistGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about a Todoist task.',
                'icon' => 'ph:note',
            ],
            'todoist_create_task' => [
                'class' => TodoistCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Todoist.',
                'icon' => 'ph:plus-circle',
            ],
            'todoist_list_projects' => [
                'class' => TodoistListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in Todoist.',
                'icon' => 'ph:folders',
            ],
            'todoist_get_project' => [
                'class' => TodoistGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a Todoist project.',
                'icon' => 'ph:folder-open',
            ],
            'todoist_list_labels' => [
                'class' => TodoistListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List all personal labels in Todoist.',
                'icon' => 'ph:tag',
            ],
            'todoist_get_current_user' => [
                'class' => TodoistGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Todoist user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/todoist.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool { return true; }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    private function resolveService(array $context = []): TodoistService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);
            return new TodoistService(
                accessToken: $creds->get('todoist', 'access_token', '', $account),
            );
        }
        return app(TodoistService::class);
    }
}
