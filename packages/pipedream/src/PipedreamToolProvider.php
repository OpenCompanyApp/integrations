<?php

namespace OpenCompany\Integrations\Pipedream;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamListWorkflows;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamGetWorkflow;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamListComponents;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamGetComponent;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamListConnectedAccounts;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamListTriggers;
use OpenCompany\Integrations\Pipedream\Tools\PipedreamGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class PipedreamToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'pipedream';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Pipedream',
            'description' => 'Automation platform',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:pipedream',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Pipedream',
            'description' => 'Automation platform for connecting APIs and building workflows',
            'icon' => 'ph:flow-arrow',
            'logo' => 'simple-icons:pipedream',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://pipedream.com/docs/api/rest',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Pipedream access token',
                'hint' => 'Generate a personal access token in your Pipedream account settings under "API Access"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.pipedream.com',
                'hint' => 'Use <code>https://api.pipedream.com</code> for the default Pipedream API',
                'default' => 'https://api.pipedream.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.pipedream.com', '/');

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
                    'error' => "Could not reach Pipedream API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Pipedream API as " . ($json['data']['name'] ?? $json['data']['email'] ?? 'user') . ".",
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
            'pipedream_list_workflows' => [
                'class' => PipedreamListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List automation workflows.',
                'icon' => 'ph:flow-arrow',
            ],
            'pipedream_get_workflow' => [
                'class' => PipedreamGetWorkflow::class,
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Get details of a specific workflow.',
                'icon' => 'ph:flow-arrow',
            ],
            'pipedream_list_components' => [
                'class' => PipedreamListComponents::class,
                'type' => 'read',
                'name' => 'List Components',
                'description' => 'List available components (actions, triggers).',
                'icon' => 'ph:puzzle-piece',
            ],
            'pipedream_get_component' => [
                'class' => PipedreamGetComponent::class,
                'type' => 'read',
                'name' => 'Get Component',
                'description' => 'Get details of a specific component.',
                'icon' => 'ph:puzzle-piece',
            ],
            'pipedream_list_connected_accounts' => [
                'class' => PipedreamListConnectedAccounts::class,
                'type' => 'read',
                'name' => 'List Connected Accounts',
                'description' => 'List connected third-party accounts.',
                'icon' => 'ph:plug',
            ],
            'pipedream_list_triggers' => [
                'class' => PipedreamListTriggers::class,
                'type' => 'read',
                'name' => 'List Triggers',
                'description' => 'List event triggers for a workflow.',
                'icon' => 'ph:lightning',
            ],
            'pipedream_get_current_user' => [
                'class' => PipedreamGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/pipedream.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.pipedream.com'],
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

            $service = new PipedreamService(
                accessToken: $creds->get('pipedream', 'access_token', '', $account),
                baseUrl: $creds->get('pipedream', 'url', 'https://api.pipedream.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PipedreamService::class));
    }
}
