<?php

namespace OpenCompany\Integrations\Todoist;

use OpenCompany\Integrations\Core\Contracts\ConfigurableIntegration;
use OpenCompany\Integrations\Core\Contracts\CredentialResolver;
use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Contracts\ToolProvider;
use OpenCompany\Integrations\Todoist\Tools\TodoistCloseTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateComment;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistCreateTask;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteProject;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteSection;
use OpenCompany\Integrations\Todoist\Tools\TodoistDeleteTask;
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
     * Get metadata about the Todoist application.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Todoist',
            'description' => 'Task management — create, organize, and track tasks, projects, and sections.',
            'icon' => 'ph:check-square',
        ];
    }

    /**
     * Get all available Todoist tools indexed by slug.
     */
    public function tools(): array
    {
        return [
            'todoist_create_task' => ['class' => TodoistCreateTask::class, 'type' => 'write', 'name' => 'Create Task', 'description' => 'Create a new task in Todoist', 'icon' => 'ph:plus-circle'],
            'todoist_get_task' => ['class' => TodoistGetTask::class, 'type' => 'read', 'name' => 'Get Task', 'description' => 'Retrieve a single task by ID', 'icon' => 'ph:eye'],
            'todoist_update_task' => ['class' => TodoistUpdateTask::class, 'type' => 'write', 'name' => 'Update Task', 'description' => 'Update an existing task', 'icon' => 'ph:pencil'],
            'todoist_delete_task' => ['class' => TodoistDeleteTask::class, 'type' => 'write', 'name' => 'Delete Task', 'description' => 'Delete a task permanently', 'icon' => 'ph:trash'],
            'todoist_close_task' => ['class' => TodoistCloseTask::class, 'type' => 'write', 'name' => 'Close Task', 'description' => 'Mark a task as completed', 'icon' => 'ph:check'],
            'todoist_reopen_task' => ['class' => TodoistReopenTask::class, 'type' => 'write', 'name' => 'Reopen Task', 'description' => 'Reopen a completed task', 'icon' => 'ph:arrow-counter-clockwise'],
            'todoist_list_tasks' => ['class' => TodoistListTasks::class, 'type' => 'read', 'name' => 'List Tasks', 'description' => 'List tasks with optional filters', 'icon' => 'ph:list'],
            'todoist_quick_add' => ['class' => TodoistQuickAdd::class, 'type' => 'write', 'name' => 'Quick Add Task', 'description' => 'Add a task using natural language', 'icon' => 'ph:lightning'],
            'todoist_create_project' => ['class' => TodoistCreateProject::class, 'type' => 'write', 'name' => 'Create Project', 'description' => 'Create a new project', 'icon' => 'ph:folder-plus'],
            'todoist_get_project' => ['class' => TodoistGetProject::class, 'type' => 'read', 'name' => 'Get Project', 'description' => 'Retrieve a single project by ID', 'icon' => 'ph:folder-open'],
            'todoist_update_project' => ['class' => TodoistUpdateProject::class, 'type' => 'write', 'name' => 'Update Project', 'description' => 'Update an existing project', 'icon' => 'ph:folder'],
            'todoist_delete_project' => ['class' => TodoistDeleteProject::class, 'type' => 'write', 'name' => 'Delete Project', 'description' => 'Delete a project permanently', 'icon' => 'ph:folder-minus'],
            'todoist_list_projects' => ['class' => TodoistListProjects::class, 'type' => 'read', 'name' => 'List Projects', 'description' => 'List all projects', 'icon' => 'ph:folders'],
            'todoist_create_section' => ['class' => TodoistCreateSection::class, 'type' => 'write', 'name' => 'Create Section', 'description' => 'Create a section in a project', 'icon' => 'ph:columns'],
            'todoist_get_section' => ['class' => TodoistGetSection::class, 'type' => 'read', 'name' => 'Get Section', 'description' => 'Retrieve a single section by ID', 'icon' => 'ph:column'],
            'todoist_delete_section' => ['class' => TodoistDeleteSection::class, 'type' => 'write', 'name' => 'Delete Section', 'description' => 'Delete a section permanently', 'icon' => 'ph:x-square'],
            'todoist_list_sections' => ['class' => TodoistListSections::class, 'type' => 'read', 'name' => 'List Sections', 'description' => 'List sections for a project', 'icon' => 'ph:columns'],
            'todoist_create_comment' => ['class' => TodoistCreateComment::class, 'type' => 'write', 'name' => 'Create Comment', 'description' => 'Add a comment to a task or project', 'icon' => 'ph:chat-circle-text'],
            'todoist_list_comments' => ['class' => TodoistListComments::class, 'type' => 'read', 'name' => 'List Comments', 'description' => 'List comments for a task or project', 'icon' => 'ph:chat-circle'],
            'todoist_list_labels' => ['class' => TodoistListLabels::class, 'type' => 'read', 'name' => 'List Labels', 'description' => 'List all personal labels', 'icon' => 'ph:tag'],
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
     * @param string               $class   Fully-qualified tool class name.
     * @param array<string, mixed> $context Context including optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $service = new TodoistService(
                apiToken: $creds->get('todoist', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TodoistService::class));
    }

    /**
     * Get the path to supplementary Lua documentation, if any.
     */
    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/todoist.md';
    }

    // ─── ConfigurableIntegration ───────────────────────────────────────────

    /**
     * Get integration metadata for display in the OpenCompany UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Todoist',
            'description' => 'Manage tasks, projects, sections, labels, and comments in Todoist.',
            'icon' => 'ph:check-square',
            'category' => 'productivity',
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
                'key' => 'api_token',
                'label' => 'API Token',
                'type' => 'text',
                'secret' => true,
                'help' => 'Your Todoist personal access token from Settings → Integrations → API Token.',
            ],
        ];
    }

    /**
     * Test the Todoist connection using the provided configuration.
     *
     * @param array<string, mixed> $config Configuration containing the api_token.
     * @return array<string, mixed> Result with success status and user info or error message.
     */
    public function testConnection(array $config): array
    {
        try {
            $service = new TodoistService(
                apiToken: $config['api_token'] ?? '',
            );

            if (!$service->isConfigured()) {
                return ['success' => false, 'error' => 'API token is required.'];
            }

            $user = $service->testConnection();

            return [
                'success' => true,
                'message' => "Connected as {$user['full_name']} ({$user['email']})",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the Todoist configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_token' => ['required', 'string', 'min:10'],
        ];
    }

    /**
     * Get the credential fields required by this integration.
     */
    public function credentialFields(): array
    {
        return [
            'api_token' => [
                'label' => 'API Token',
                'type' => 'text',
                'secret' => true,
            ],
        ];
    }
}
