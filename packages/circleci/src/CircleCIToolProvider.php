<?php

namespace OpenCompany\Integrations\CircleCI;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListPipelines;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIGetPipeline;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListWorkflows;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIGetWorkflow;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIListProjects;
use OpenCompany\Integrations\CircleCI\Tools\CircleCITriggerPipeline;
use OpenCompany\Integrations\CircleCI\Tools\CircleCIGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CircleCIToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'circleci';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CircleCI',
            'description' => 'CI/CD pipeline management',
            'icon' => 'ph:git-branch',
            'logo' => 'simple-icons:circleci',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CircleCI',
            'description' => 'Continuous integration and delivery platform',
            'icon' => 'ph:git-branch',
            'logo' => 'simple-icons:circleci',
            'category' => 'devtools',
            'badge' => 'verified',
            'docs_url' => 'https://circleci.com/docs/api/v2/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Personal API Token',
                'placeholder' => 'Enter your CircleCI personal API token',
                'hint' => 'Generate a personal API token in CircleCI under User Settings → Personal API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://circleci.com/api',
                'hint' => 'Use <code>https://circleci.com/api</code> for CircleCI Cloud, or your CircleCI Server URL',
                'default' => 'https://circleci.com/api',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://circleci.com/api', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Circle-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach CircleCI API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}): " . ($json['message'] ?? 'Unknown error'),
                ];
            }

            $login = $json['login'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to CircleCI API as {$login}.",
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
            'circleci_list_pipelines' => [
                'class' => CircleCIListPipelines::class,
                'type' => 'read',
                'name' => 'List Pipelines',
                'description' => 'List recent pipelines for an organization.',
                'icon' => 'ph:list',
            ],
            'circleci_get_pipeline' => [
                'class' => CircleCIGetPipeline::class,
                'type' => 'read',
                'name' => 'Get Pipeline',
                'description' => 'Get details for a specific pipeline.',
                'icon' => 'ph:git-branch',
            ],
            'circleci_list_workflows' => [
                'class' => CircleCIListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List workflows for a specific pipeline.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_get_workflow' => [
                'class' => CircleCIGetWorkflow::class,
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Get details for a specific workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'circleci_list_projects' => [
                'class' => CircleCIListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects for an organization.',
                'icon' => 'ph:folder',
            ],
            'circleci_trigger_pipeline' => [
                'class' => CircleCITriggerPipeline::class,
                'type' => 'write',
                'name' => 'Trigger Pipeline',
                'description' => 'Trigger a new pipeline for a project.',
                'icon' => 'ph:play',
            ],
            'circleci_get_current_user' => [
                'class' => CircleCIGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/circleci.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'CircleCI API URL', 'required' => false, 'default' => 'https://circleci.com/api'],
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

            $service = new CircleCIService(
                accessToken: $creds->get('circleci', 'access_token', '', $account),
                baseUrl: $creds->get('circleci', 'url', 'https://circleci.com/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(CircleCIService::class));
    }
}
