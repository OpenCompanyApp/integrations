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
use OpenCompany\Integrations\Todoist\Tools\TodoistCloseTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateComment;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistListComments;
use OpenCompany\Integrations\Todoist\Tools\TodoistListSections;
use OpenCompany\Integrations\Todoist\Tools\TodoistQuickAdd;
use OpenCompany\Integrations\Todoist\Tools\TodoistReopenTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistUpdateProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistUpdateTask;
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
            'todoist_close_task' => [
                'class' => TodoistCloseTask::class,
                'type' => 'write',
                'name' => 'Close Task',
                'description' => 'Mark a task as completed (close it). The task will move to the completed view.',
                'icon' => 'ph:wrench',
            ],
            'todoist_create_comment' => [
                'class' => TodoistCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to a Todoist task or project. Provide either task_id or project_id along with the content.',
                'icon' => 'ph:wrench',
            ],
            'todoist_create_project' => [
                'class' => TodoistCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project in Todoist. Projects can be nested using parent_id.',
                'icon' => 'ph:wrench',
            ],
            'todoist_create_section' => [
                'class' => TodoistCreateSection::class,
                'type' => 'write',
                'name' => 'Create Section',
                'description' => 'Create a new section within a Todoist project to organize tasks into groups.',
                'icon' => 'ph:wrench',
            ],
            'todoist_create_task' => [
                'class' => TodoistCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Todoist.',
                'icon' => 'ph:wrench',
            ],
            'todoist_delete_project' => [
                'class' => TodoistDeleteProject::class,
                'type' => 'write',
                'name' => 'Delete Project',
                'description' => 'Permanently delete a project and all its tasks from Todoist. This action cannot be undone.',
                'icon' => 'ph:wrench',
            ],
            'todoist_delete_section' => [
                'class' => TodoistDeleteSection::class,
                'type' => 'write',
                'name' => 'Delete Section',
                'description' => 'Permanently delete a section from Todoist. This action cannot be undone.',
                'icon' => 'ph:wrench',
            ],
            'todoist_delete_task' => [
                'class' => TodoistDeleteTask::class,
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Permanently delete a task from Todoist. This action cannot be undone.',
                'icon' => 'ph:wrench',
            ],
            'todoist_get_current_user' => [
                'class' => TodoistGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Todoist user.',
                'icon' => 'ph:wrench',
            ],
            'todoist_get_project' => [
                'class' => TodoistGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a Todoist project.',
                'icon' => 'ph:wrench',
            ],
            'todoist_get_section' => [
                'class' => TodoistGetSection::class,
                'type' => 'read',
                'name' => 'Get Section',
                'description' => 'Retrieve a single Todoist section by its ID.',
                'icon' => 'ph:wrench',
            ],
            'todoist_get_task' => [
                'class' => TodoistGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about a Todoist task.',
                'icon' => 'ph:wrench',
            ],
            'todoist_list_comments' => [
                'class' => TodoistListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments for a Todoist task or project. Provide either task_id or project_id.',
                'icon' => 'ph:wrench',
            ],
            'todoist_list_labels' => [
                'class' => TodoistListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List all personal labels in Todoist.',
                'icon' => 'ph:wrench',
            ],
            'todoist_list_projects' => [
                'class' => TodoistListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in Todoist.',
                'icon' => 'ph:wrench',
            ],
            'todoist_list_sections' => [
                'class' => TodoistListSections::class,
                'type' => 'read',
                'name' => 'List Sections',
                'description' => 'List all sections, optionally filtered by a specific project ID.',
                'icon' => 'ph:wrench',
            ],
            'todoist_list_tasks' => [
                'class' => TodoistListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Todoist with optional filters.',
                'icon' => 'ph:wrench',
            ],
            'todoist_quick_add' => [
                'class' => TodoistQuickAdd::class,
                'type' => 'write',
                'name' => 'Quick Add',
                'description' => 'Add a task using Todoist\'s natural language quick-add. Examples: "Buy milk tomorrow", "Meeting with team every Monday @Work p1".',
                'icon' => 'ph:wrench',
            ],
            'todoist_reopen_task' => [
                'class' => TodoistReopenTask::class,
                'type' => 'write',
                'name' => 'Reopen Task',
                'description' => 'Reopen a completed task, returning it to the active task list.',
                'icon' => 'ph:wrench',
            ],
            'todoist_update_project' => [
                'class' => TodoistUpdateProject::class,
                'type' => 'write',
                'name' => 'Update Project',
                'description' => 'Update an existing project in Todoist. Only the fields provided will be changed.',
                'icon' => 'ph:wrench',
            ],
            'todoist_update_task' => [
                'class' => TodoistUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing task in Todoist. Only the fields provided will be changed.',
                'icon' => 'ph:wrench',
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
