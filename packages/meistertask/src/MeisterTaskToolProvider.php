<?php

namespace OpenCompany\Integrations\MeisterTask;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskListProjects;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskGetProject;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskCreateTask;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskListTasks;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskGetTask;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskUpdateTask;
use OpenCompany\Integrations\MeisterTask\Tools\MeisterTaskGetCurrentUser;

class MeisterTaskToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'meistertask';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'projects, tasks',
            'description' => 'Project & task management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:meistertask',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'MeisterTask',
            'description' => 'Kanban-style project and task management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:meistertask',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.meistertask.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your MeisterTask access token',
                'hint' => 'Generate a token in your MeisterTask account settings under "Integrations & Apps"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://www.meistertask.com/api',
                'hint' => 'Use <code>https://www.meistertask.com/api</code> for cloud, or your custom endpoint',
                'default' => 'https://www.meistertask.com/api',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://www.meistertask.com/api', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach MeisterTask API at {$baseUrl}. Check the URL.",
                ];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to MeisterTask as {$name}.",
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
            'meistertask_list_projects' => [
                'class' => MeisterTaskListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all MeisterTask projects you have access to.',
                'icon' => 'ph:folder',
            ],
            'meistertask_get_project' => [
                'class' => MeisterTaskGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific MeisterTask project.',
                'icon' => 'ph:folder-open',
            ],
            'meistertask_create_task' => [
                'class' => MeisterTaskCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in a MeisterTask project.',
                'icon' => 'ph:plus-circle',
            ],
            'meistertask_list_tasks' => [
                'class' => MeisterTaskListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks across projects with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'meistertask_get_task' => [
                'class' => MeisterTaskGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details of a specific MeisterTask task.',
                'icon' => 'ph:check-square',
            ],
            'meistertask_update_task' => [
                'class' => MeisterTaskUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing MeisterTask task.',
                'icon' => 'ph:pencil-simple',
            ],
            'meistertask_get_current_user' => [
                'class' => MeisterTaskGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/meistertask.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://www.meistertask.com/api'],
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

            $service = new MeisterTaskService(
                accessToken: $creds->get('meistertask', 'access_token', '', $account),
                baseUrl: $creds->get('meistertask', 'url', 'https://www.meistertask.com/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(MeisterTaskService::class));
    }
}
