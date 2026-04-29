<?php

namespace OpenCompany\Integrations\CloudConvert;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJob;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetJob;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListJobs;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateTask;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetTask;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListTasks;
use OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CloudConvertToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'cloudconvert';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CloudConvert',
            'description' => 'File conversion & processing',
            'icon' => 'ph:file-arrow-down',
            'logo' => 'simple-icons:cloudconvert',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CloudConvert',
            'description' => 'File conversion and processing API supporting 200+ formats',
            'icon' => 'ph:file-arrow-down',
            'logo' => 'simple-icons:cloudconvert',
            'category' => 'files',
            'badge' => 'verified',
            'docs_url' => 'https://cloudconvert.com/api/v2',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your CloudConvert API key',
                'hint' => 'Find your API key in the CloudConvert dashboard under "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.cloudconvert.com/v2',
                'hint' => 'Use <code>https://api.cloudconvert.com/v2</code> for the cloud service, or your self-hosted URL',
                'default' => 'https://api.cloudconvert.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.cloudconvert.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach CloudConvert API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to CloudConvert API as " . ($json['data']['name'] ?? 'user') . ".",
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
            'cloudconvert_create_job' => [
                'class' => CloudConvertCreateJob::class,
                'type' => 'write',
                'name' => 'Create Job',
                'description' => 'Create a new CloudConvert job with tasks.',
                'icon' => 'ph:plus-circle',
            ],
            'cloudconvert_get_job' => [
                'class' => CloudConvertGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get details and status of a CloudConvert job.',
                'icon' => 'ph:eye',
            ],
            'cloudconvert_list_jobs' => [
                'class' => CloudConvertListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List CloudConvert jobs with optional filtering.',
                'icon' => 'ph:list',
            ],
            'cloudconvert_create_task' => [
                'class' => CloudConvertCreateTask::class,
                'type' => 'write',
                'name' => 'Create Task',
                'description' => 'Create a standalone CloudConvert task.',
                'icon' => 'ph:plus-circle',
            ],
            'cloudconvert_get_task' => [
                'class' => CloudConvertGetTask::class,
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details and status of a CloudConvert task.',
                'icon' => 'ph:eye',
            ],
            'cloudconvert_list_tasks' => [
                'class' => CloudConvertListTasks::class,
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List CloudConvert tasks with optional filtering.',
                'icon' => 'ph:list',
            ],
            'cloudconvert_get_current_user' => [
                'class' => CloudConvertGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated CloudConvert user profile and credits.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/cloudconvert.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cloudconvert.com/v2'],
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

            $service = new CloudConvertService(
                apiKey: $creds->get('cloudconvert', 'api_key', '', $account),
                baseUrl: $creds->get('cloudconvert', 'url', 'https://api.cloudconvert.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(CloudConvertService::class));
    }
}
