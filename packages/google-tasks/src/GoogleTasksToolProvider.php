<?php

namespace OpenCompany\Integrations\GoogleTasks;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksListTaskLists;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksGetTaskList;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksCreateTaskList;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksListTasks;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksGetTask;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksCreateTask;
use OpenCompany\Integrations\GoogleTasks\Tools\GoogleTasksGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GoogleTasksToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'google-tasks';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'task lists, tasks',
            'description' => 'Task management',
            'icon' => 'ph:check-square',
            'logo' => 'logos:google-tasks',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Google Tasks',
            'description' => 'Manage task lists and tasks with Google Tasks',
            'icon' => 'ph:check-square',
            'logo' => 'logos:google-tasks',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.google.com/tasks/reference/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Google OAuth access token',
                'hint' => 'Provide an OAuth 2.0 access token with <code>https://www.googleapis.com/auth/tasks</code> scope',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://tasks.googleapis.com',
                'hint' => 'Override only if using a proxy or mock server',
                'default' => 'https://tasks.googleapis.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://tasks.googleapis.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/tasks/v1/users/@me/lists', [
                'maxResults' => 1,
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Google Tasks API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? $response->body();
                return ['success' => false, 'error' => "Authentication failed: {$error}"];
            }

            return [
                'success' => true,
                'message' => 'Connected to Google Tasks API.',
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
            'gtasks_list_task_lists' => [
                'class' => GoogleTasksListTaskLists::class,
                'type' => 'read',
                'name' => 'List Task Lists',
                'description' => 'List all task lists for the authenticated user.',
                'icon' => 'ph:list-bullets',
            ],
            'gtasks_get_task_list' => [
                'class' => GoogleTasksGetTaskList::class,
                'type' => 'read',
                'name' => 'Get Task List',
                'description' => 'Get a specific task list by ID.',
                'icon' => 'ph:list',
            ],
            'gtasks_create_task_list' => [
                'class' => GoogleTasksCreateTaskList::class,
                'type' => 'write',
                'name' => 'Create Task List',
                'description' => 'Create a new task list.',
                'icon' => 'ph:plus-circle',
            ],
            'gtasks_list_tasks' => [
                'class' => GoogleTasksListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks in a task list.',
                'icon' => 'ph:checks',
            ],
            'gtasks_get_task' => [
                'class' => GoogleTasksGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get a specific task by ID.',
                'icon' => 'ph:check-square',
            ],
            'gtasks_create_task' => [
                'class' => GoogleTasksCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in a task list.',
                'icon' => 'ph:plus',
            ],
            'gtasks_get_current_user' => [
                'class' => GoogleTasksGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/google-tasks.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://tasks.googleapis.com'],
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

            $service = new GoogleTasksService(
                accessToken: $creds->get('google-tasks', 'access_token', '', $account),
                baseUrl: $creds->get('google-tasks', 'url', 'https://tasks.googleapis.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(GoogleTasksService::class));
    }
}
