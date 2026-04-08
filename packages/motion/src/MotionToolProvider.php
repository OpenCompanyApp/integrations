<?php

namespace OpenCompany\Integrations\Motion;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Motion\Tools\MotionListTasks;
use OpenCompany\Integrations\Motion\Tools\MotionGetTask;
use OpenCompany\Integrations\Motion\Tools\MotionCreateTask;
use OpenCompany\Integrations\Motion\Tools\MotionListProjects;
use OpenCompany\Integrations\Motion\Tools\MotionGetProject;
use OpenCompany\Integrations\Motion\Tools\MotionListSchedules;
use OpenCompany\Integrations\Motion\Tools\MotionGetCurrentUser;

class MotionToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'motion';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tasks, projects, schedules',
            'description' => 'Task and project management',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:motion',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Motion',
            'description' => 'AI-powered task and project management with intelligent scheduling',
            'icon' => 'ph:check-square',
            'logo' => 'simple-icons:motion',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.motion.dev',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Motion API access token',
                'hint' => 'Generate an API key in your Motion account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.usemotion.com',
                'hint' => 'Use <code>https://api.usemotion.com</code> for the standard Motion API',
                'default' => 'https://api.usemotion.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.usemotion.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Motion API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = ($json['name'] ?? null) ?? ($json['email'] ?? 'Unknown user');

            return [
                'success' => true,
                'message' => "Connected to Motion API as {$userName}.",
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
            'motion_list_tasks' => [
                'class' => MotionListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List tasks with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'motion_get_task' => [
                'class' => MotionGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details of a specific task.',
                'icon' => 'ph:check-square',
            ],
            'motion_create_task' => [
                'class' => MotionCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new task in Motion.',
                'icon' => 'ph:plus-square',
            ],
            'motion_list_projects' => [
                'class' => MotionListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in Motion.',
                'icon' => 'ph:folder',
            ],
            'motion_get_project' => [
                'class' => MotionGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'motion_list_schedules' => [
                'class' => MotionListSchedules::class,
                'type' => 'read',
                'name' => 'List Schedules',
                'description' => 'List schedules within a date range.',
                'icon' => 'ph:calendar',
            ],
            'motion_get_current_user' => [
                'class' => MotionGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/motion.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://api.usemotion.com'],
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

            $service = new MotionService(
                accessToken: $creds->get('motion', 'access_token', '', $account),
                baseUrl: $creds->get('motion', 'url', 'https://api.usemotion.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(MotionService::class));
    }
}
