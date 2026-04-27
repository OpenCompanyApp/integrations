<?php

namespace OpenCompany\Integrations\Onfleet;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetListTasks;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetGetTask;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetCreateTask;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetUpdateTask;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetDeleteTask;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetListWorkers;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetListTeams;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetListRecipients;
use OpenCompany\Integrations\Onfleet\Tools\OnfleetGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class OnfleetToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
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
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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
        return 'onfleet';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tasks, workers, teams, recipients',
            'description' => 'Delivery management',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:onfleet',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Onfleet',
            'description' => 'Last-mile delivery management platform',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:onfleet',
            'category' => 'logistics',
            'badge' => 'verified',
            'docs_url' => 'https://docs.onfleet.com/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Onfleet API key',
                'hint' => 'Find your API key in Onfleet under Settings > API & Webhooks',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://onfleet.com/api/v2',
                'hint' => 'Use the default Onfleet API URL unless you have a custom endpoint',
                'default' => 'https://onfleet.com/api/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://onfleet.com/api/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, '')
              ->timeout(10)
              ->get($baseUrl . '/auth');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Onfleet API successfully.',
                ];
            }

            return [
                'success' => false,
                'error' => "Onfleet API returned HTTP {$response->status()}: " . ($response->json('message') ?? $response->body()),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'onfleet_list_tasks' => [
                'class' => OnfleetListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List delivery tasks with optional filters.',
                'icon' => 'ph:list-checks',
            ],
            'onfleet_get_task' => [
                'class' => OnfleetGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get detailed information about a specific task.',
                'icon' => 'ph:package',
            ],
            'onfleet_create_task' => [
                'class' => OnfleetCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a new delivery task.',
                'icon' => 'ph:plus-circle',
            ],
            'onfleet_update_task' => [
                'class' => OnfleetUpdateTask::class,
                'type' => 'write',
                'name' => 'Update Task',
                'description' => 'Update an existing delivery task.',
                'icon' => 'ph:pencil-simple',
            ],
            'onfleet_delete_task' => [
                'class' => OnfleetDeleteTask::class,
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Delete a delivery task.',
                'icon' => 'ph:trash',
            ],
            'onfleet_list_workers' => [
                'class' => OnfleetListWorkers::class,
                'type' => 'read',
                'name' => 'List Workers',
                'description' => 'List all workers (drivers).',
                'icon' => 'ph:users',
            ],
            'onfleet_list_teams' => [
                'class' => OnfleetListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all teams.',
                'icon' => 'ph:users-three',
            ],
            'onfleet_list_recipients' => [
                'class' => OnfleetListRecipients::class,
                'type' => 'read',
                'name' => 'List Recipients',
                'description' => 'List recipients (delivery customers).',
                'icon' => 'ph:address-book',
            ],
            'onfleet_get_current_user' => [
                'class' => OnfleetGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Onfleet user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/onfleet.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://onfleet.com/api/v2'],
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

            $service = new OnfleetService(
                apiKey: $creds->get('onfleet', 'api_key', '', $account),
                baseUrl: $creds->get('onfleet', 'url', 'https://onfleet.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(OnfleetService::class));
    }
}
