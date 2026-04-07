<?php

namespace OpenCompany\Integrations\Wrike;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Wrike\Tools\WrikeAddComment;
use OpenCompany\Integrations\Wrike\Tools\WrikeCreateFolder;
use OpenCompany\Integrations\Wrike\Tools\WrikeCreateTask;
use OpenCompany\Integrations\Wrike\Tools\WrikeGetCurrentUser;
use OpenCompany\Integrations\Wrike\Tools\WrikeGetFolder;
use OpenCompany\Integrations\Wrike\Tools\WrikeGetProject;
use OpenCompany\Integrations\Wrike\Tools\WrikeGetSpace;
use OpenCompany\Integrations\Wrike\Tools\WrikeGetTask;
use OpenCompany\Integrations\Wrike\Tools\WrikeListContacts;
use OpenCompany\Integrations\Wrike\Tools\WrikeListFolders;
use OpenCompany\Integrations\Wrike\Tools\WrikeListProjects;
use OpenCompany\Integrations\Wrike\Tools\WrikeListSpaces;
use OpenCompany\Integrations\Wrike\Tools\WrikeListTasks;
use OpenCompany\Integrations\Wrike\Tools\WrikeUpdateTask;

/**
 * Registers all Wrike tools and provides integration metadata.
 *
 * Exposes 14 tools covering tasks, projects, folders, spaces,
 * contacts, comments, and the current user via the ToolProvider contract.
 */
class WrikeToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'wrike';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tasks, projects, folders, and spaces',
            'description' => 'Project Management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:wrike',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Wrike',
            'description' => 'Tasks, projects, folders, and spaces',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:wrike',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.wrike.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Your Wrike Permanent Token',
                'hint' => 'Generate at <code>https://www.wrike.com/frontend/apps/#/api</code> under "Permanent Token".',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Wrike connection using the provided credentials.
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
            ])->timeout(10)->get('https://www.wrike.com/api/v4/user');

            if ($response->successful()) {
                $data = $response->json('data') ?? [];
                $entry = $data[0] ?? [];
                $firstName = $entry['firstName'] ?? 'Unknown';
                $lastName = $entry['lastName'] ?? '';
                $email = $entry['email'] ?? '';

                return [
                    'success' => true,
                    'message' => "Connected to Wrike as {$firstName} {$lastName}" . ($email ? " ({$email})" : '') . '.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Wrike API error (' . $response->status() . '): ' . $response->body(),
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
            'wrike_create_task' => [
                'class' => WrikeCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Wrike.',
                'icon' => 'ph:plus-circle',
            ],
            'wrike_get_task' => [
                'class' => WrikeGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about a Wrike task.',
                'icon' => 'ph:note',
            ],
            'wrike_update_task' => [
                'class' => WrikeUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing Wrike task.',
                'icon' => 'ph:pencil-simple',
            ],
            'wrike_list_tasks' => [
                'class' => WrikeListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in Wrike with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'wrike_add_comment' => [
                'class' => WrikeAddComment::class,
                'type' => 'write',
                'name' => 'Add Comment',
                'description' => 'Add a comment to a Wrike task.',
                'icon' => 'ph:chat-circle-text',
            ],
            // Projects
            'wrike_get_project' => [
                'class' => WrikeGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a Wrike project.',
                'icon' => 'ph:folder-open',
            ],
            'wrike_list_projects' => [
                'class' => WrikeListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in Wrike with optional filters.',
                'icon' => 'ph:folders',
            ],
            // Folders
            'wrike_create_folder' => [
                'class' => WrikeCreateFolder::class,
                'type' => 'write',
                'name' => 'Create Folder',
                'description' => 'Create a new folder in Wrike.',
                'icon' => 'ph:folder-plus',
            ],
            'wrike_get_folder' => [
                'class' => WrikeGetFolder::class,
                'type' => 'read',
                'name' => 'Get Folder',
                'description' => 'Get detailed information about a Wrike folder.',
                'icon' => 'ph:folder',
            ],
            'wrike_list_folders' => [
                'class' => WrikeListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List folders in Wrike with optional filters.',
                'icon' => 'ph:folder-simple',
            ],
            // Spaces
            'wrike_get_space' => [
                'class' => WrikeGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get detailed information about a Wrike space.',
                'icon' => 'ph:folder-open',
            ],
            'wrike_list_spaces' => [
                'class' => WrikeListSpaces::class,
                'type' => 'read',
                'name' => 'List Spaces',
                'description' => 'List spaces in Wrike.',
                'icon' => 'ph:folders',
            ],
            // Contacts
            'wrike_list_contacts' => [
                'class' => WrikeListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Wrike.',
                'icon' => 'ph:users',
            ],
            'wrike_get_current_user' => [
                'class' => WrikeGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Wrike user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wrike.md';
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
     * Resolve the WrikeService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): WrikeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new WrikeService(
                accessToken: $creds->get('wrike', 'access_token', '', $account),
            );
        }

        return app(WrikeService::class);
    }
}
