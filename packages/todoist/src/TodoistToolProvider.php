<?php

namespace OpenCompany\Integrations\Todoist;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Todoist\Tools\TodoistCloseTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateComment;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetCurrentUser;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistGetTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistListComments;
use OpenCompany\Integrations\Todoist\Tools\TodoistListLabels;
use OpenCompany\Integrations\Todoist\Tools\TodoistListProjects;
use OpenCompany\Integrations\Todoist\Tools\TodoistListSections;
use OpenCompany\Integrations\Todoist\Tools\TodoistListTasks;
use OpenCompany\Integrations\Todoist\Tools\TodoistQuickAdd;
use OpenCompany\Integrations\Todoist\Tools\TodoistReopenTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistUpdateProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistUpdateTask;

/**
 * Tool provider and configurable integration for Todoist.
 *
 * Registers all Todoist tools and provides configuration schema for
 * setting up the integration with an access token and optional base URL.
 */
class TodoistToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration's application name identifier.
     */
    public function appName(): string
    {
        return 'todoist';
    }

    /**
     * Get metadata about the Todoist application for display in the UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'tasks, projects, sections, labels',
            'description' => 'Task management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:todoist',
        ];
    }

    /**
     * Get integration metadata for display in the OpenCompany UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Todoist',
            'description' => 'Manage tasks, projects, sections, labels, and comments in Todoist.',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:todoist',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.todoist.com/rest/',
        ];
    }

    /**
     * Get the configuration schema for setting up the Todoist integration.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Todoist API token',
                'hint' => 'Generate a personal access token in Todoist at Settings → Integrations → API Token',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.todoist.com',
                'hint' => 'The Todoist API base URL. Change only if using a proxy or alternative endpoint.',
                'default' => 'https://api.todoist.com',
            ],
        ];
    }

    /**
     * Test the Todoist connection using the provided configuration.
     *
     * @param array<string, mixed> $config Configuration containing the access_token.
     * @return array<string, mixed> Result with success status and user info or error message.
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.todoist.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/sync/v9/user');

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not connect to Todoist API (HTTP {$response->status()}). Check your access token.",
                ];
            }

            $user = $response->json();

            return [
                'success' => true,
                'message' => "Connected as " . ($user['full_name'] ?? 'Unknown') . " (" . ($user['email'] ?? 'unknown') . ")",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Todoist configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string|min:10',
            'base_url' => 'nullable|url',
        ];
    }

    /**
     * Get all available Todoist tools indexed by slug.
     */
    public function tools(): array
    {
        return [
            'todoist_list_tasks' => [
                'class' => TodoistListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks with optional filters for project, section, label, or Todoist filter expressions.',
                'icon' => 'ph:list',
            ],
            'todoist_get_task' => [
                'class' => TodoistGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Retrieve a single task by ID.',
                'icon' => 'ph:eye',
            ],
            'todoist_create_task' => [
                'class' => TodoistCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Todoist.',
                'icon' => 'ph:plus-circle',
            ],
            'todoist_update_task' => [
                'class' => TodoistUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing task.',
                'icon' => 'ph:pencil',
            ],
            'todoist_delete_task' => [
                'class' => TodoistDeleteTask::class,
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Delete a task permanently.',
                'icon' => 'ph:trash',
            ],
            'todoist_close_task' => [
                'class' => TodoistCloseTask::class,
                'type' => 'write',
                'name' => 'Close Task',
                'description' => 'Mark a task as completed.',
                'icon' => 'ph:check',
            ],
            'todoist_reopen_task' => [
                'class' => TodoistReopenTask::class,
                'type' => 'write',
                'name' => 'Reopen Task',
                'description' => 'Reopen a completed task.',
                'icon' => 'ph:arrow-counter-clockwise',
            ],
            'todoist_quick_add' => [
                'class' => TodoistQuickAdd::class,
                'type' => 'write',
                'name' => 'Quick Add Task',
                'description' => 'Add a task using natural language.',
                'icon' => 'ph:lightning',
            ],
            'todoist_list_projects' => [
                'class' => TodoistListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects.',
                'icon' => 'ph:folders',
            ],
            'todoist_get_project' => [
                'class' => TodoistGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Retrieve a single project by ID.',
                'icon' => 'ph:folder-open',
            ],
            'todoist_create_project' => [
                'class' => TodoistCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project.',
                'icon' => 'ph:folder-plus',
            ],
            'todoist_update_project' => [
                'class' => TodoistUpdateProject::class,
                'type' => 'write',
                'name' => 'Update Project',
                'description' => 'Update an existing project.',
                'icon' => 'ph:folder',
            ],
            'todoist_delete_project' => [
                'class' => TodoistDeleteProject::class,
                'type' => 'write',
                'name' => 'Delete Project',
                'description' => 'Delete a project permanently.',
                'icon' => 'ph:folder-minus',
            ],
            'todoist_list_sections' => [
                'class' => TodoistListSections::class,
                'type' => 'read',
                'name' => 'List Sections',
                'description' => 'List sections for a project.',
                'icon' => 'ph:columns',
            ],
            'todoist_get_section' => [
                'class' => TodoistGetSection::class,
                'type' => 'read',
                'name' => 'Get Section',
                'description' => 'Retrieve a single section by ID.',
                'icon' => 'ph:column',
            ],
            'todoist_create_section' => [
                'class' => TodoistCreateSection::class,
                'type' => 'write',
                'name' => 'Create Section',
                'description' => 'Create a section in a project.',
                'icon' => 'ph:columns',
            ],
            'todoist_delete_section' => [
                'class' => TodoistDeleteSection::class,
                'type' => 'write',
                'name' => 'Delete Section',
                'description' => 'Delete a section permanently.',
                'icon' => 'ph:x-square',
            ],
            'todoist_list_labels' => [
                'class' => TodoistListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List all personal labels.',
                'icon' => 'ph:tag',
            ],
            'todoist_list_comments' => [
                'class' => TodoistListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments for a task or project.',
                'icon' => 'ph:chat-circle',
            ],
            'todoist_create_comment' => [
                'class' => TodoistCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to a task or project.',
                'icon' => 'ph:chat-circle-text',
            ],
            'todoist_get_current_user' => [
                'class' => TodoistGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current user profile and account details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to supplementary Lua documentation, if any.
     */
    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/todoist.md';
    }

    /**
     * Get the credential fields required by this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.todoist.com'],
        ];
    }

    /**
     * Determine whether this integration is active (always true for Todoist).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally for a specific account context.
     *
     * Supports multi-account by resolving per-account credentials when an
     * account identifier is provided in the context.
     *
     * @param string               $class   Fully-qualified tool class name.
     * @param array<string, mixed> $context Context including optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new TodoistService(
                accessToken: $creds->get('todoist', 'access_token', '', $account),
                baseUrl: $creds->get('todoist', 'base_url', 'https://api.todoist.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(TodoistService::class));
    }
}
