<?php

namespace OpenCompany\Integrations\Asana;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Asana\Tools\AsanaAddComment;
use OpenCompany\Integrations\Asana\Tools\AsanaCreateProject;
use OpenCompany\Integrations\Asana\Tools\AsanaCreateSubtask;
use OpenCompany\Integrations\Asana\Tools\AsanaCreateTag;
use OpenCompany\Integrations\Asana\Tools\AsanaCreateTask;
use OpenCompany\Integrations\Asana\Tools\AsanaDeleteTask;
use OpenCompany\Integrations\Asana\Tools\AsanaGetCurrentUser;
use OpenCompany\Integrations\Asana\Tools\AsanaGetProject;
use OpenCompany\Integrations\Asana\Tools\AsanaGetTask;
use OpenCompany\Integrations\Asana\Tools\AsanaGetUser;
use OpenCompany\Integrations\Asana\Tools\AsanaGetUserTaskList;
use OpenCompany\Integrations\Asana\Tools\AsanaListComments;
use OpenCompany\Integrations\Asana\Tools\AsanaListProjects;
use OpenCompany\Integrations\Asana\Tools\AsanaListSections;
use OpenCompany\Integrations\Asana\Tools\AsanaListTags;
use OpenCompany\Integrations\Asana\Tools\AsanaListTasks;
use OpenCompany\Integrations\Asana\Tools\AsanaListTeams;
use OpenCompany\Integrations\Asana\Tools\AsanaListUsers;
use OpenCompany\Integrations\Asana\Tools\AsanaListWorkspaces;
use OpenCompany\Integrations\Asana\Tools\AsanaUpdateTask;

/**
 * Registers all Asana tools and provides integration metadata.
 *
 * Exposes 20 tools covering tasks, projects, sections, workspaces,
 * teams, users, tags, and stories (comments) via the ToolProvider contract.
 */
class AsanaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'asana';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tasks, projects, sections, workspaces, and teams',
            'description' => 'Project Management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:asana',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Asana',
            'description' => 'Tasks, projects, sections, workspaces, teams, and tags',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:asana',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.asana.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Your Asana Personal Access Token',
                'hint' => 'Generate at <code>https://app.asana.com/0/developer-console</code> under "Personal Access Tokens".',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Asana connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'Access Token is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://app.asana.com/api/1.0/users/me');

            if ($response->successful()) {
                $data = $response->json('data') ?? [];
                $name = $data['name'] ?? 'Unknown';
                $email = $data['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Asana as {$name}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Asana API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Tasks
            'asana_create_task' => [
                'class' => AsanaCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Asana.',
                'icon' => 'ph:plus-circle',
            ],
            'asana_get_task' => [
                'class' => AsanaGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about an Asana task.',
                'icon' => 'ph:note',
            ],
            'asana_update_task' => [
                'class' => AsanaUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing Asana task.',
                'icon' => 'ph:pencil-simple',
            ],
            'asana_delete_task' => [
                'class' => AsanaDeleteTask::class,
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Delete an Asana task permanently.',
                'icon' => 'ph:trash',
            ],
            'asana_list_tasks' => [
                'class' => AsanaListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Asana with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'asana_create_subtask' => [
                'class' => AsanaCreateSubtask::class,
                'type' => 'write',
                'name' => 'Create Subtask',
                'description' => 'Create a subtask under an existing Asana task.',
                'icon' => 'ph:list-dashes',
            ],
            'asana_add_comment' => [
                'class' => AsanaAddComment::class,
                'type' => 'write',
                'name' => 'Add Comment',
                'description' => 'Add a comment to an Asana task.',
                'icon' => 'ph:chat-circle-text',
            ],
            'asana_list_comments' => [
                'class' => AsanaListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments (stories) on an Asana task.',
                'icon' => 'ph:chats-circle',
            ],
            // Projects
            'asana_create_project' => [
                'class' => AsanaCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project in Asana.',
                'icon' => 'ph:folder-plus',
            ],
            'asana_get_project' => [
                'class' => AsanaGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about an Asana project.',
                'icon' => 'ph:folder-open',
            ],
            'asana_list_projects' => [
                'class' => AsanaListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in Asana with optional filters.',
                'icon' => 'ph:folders',
            ],
            'asana_list_sections' => [
                'class' => AsanaListSections::class,
                'type' => 'read',
                'name' => 'List Sections',
                'description' => 'List sections in an Asana project.',
                'icon' => 'ph:columns',
            ],
            // Workspaces & Teams
            'asana_list_workspaces' => [
                'class' => AsanaListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List all workspaces the authenticated user has access to.',
                'icon' => 'ph:buildings',
            ],
            'asana_list_teams' => [
                'class' => AsanaListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List teams in an Asana workspace.',
                'icon' => 'ph:users-three',
            ],
            'asana_list_users' => [
                'class' => AsanaListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in an Asana workspace.',
                'icon' => 'ph:users',
            ],
            'asana_get_user' => [
                'class' => AsanaGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get detailed information about an Asana user.',
                'icon' => 'ph:user',
            ],
            'asana_get_user_task_list' => [
                'class' => AsanaGetUserTaskList::class,
                'type' => 'read',
                'name' => 'Get User Task List',
                'description' => 'Get the user task list for a given user and workspace.',
                'icon' => 'ph:user-list',
            ],
            // Tags
            'asana_list_tags' => [
                'class' => AsanaListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List tags in an Asana workspace.',
                'icon' => 'ph:tag',
            ],
            'asana_create_tag' => [
                'class' => AsanaCreateTag::class,
                'type' => 'write',
                'name' => 'Create Tag',
                'description' => 'Create a new tag in Asana.',
                'icon' => 'ph:tag-simple',
            ],
            'asana_get_current_user' => [
                'class' => AsanaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Asana user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/asana.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
     * Resolve the AsanaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): AsanaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new AsanaService(
                accessToken: $creds->get('asana', 'access_token', '', $account),
            );
        }

        return app(AsanaService::class);
    }
}
