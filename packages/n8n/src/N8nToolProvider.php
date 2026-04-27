<?php

namespace OpenCompany\Integrations\N8n;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\N8n\Tools\N8nListWorkflows;
use OpenCompany\Integrations\N8n\Tools\N8nGetWorkflow;
use OpenCompany\Integrations\N8n\Tools\N8nCreateWorkflow;
use OpenCompany\Integrations\N8n\Tools\N8nListExecutions;
use OpenCompany\Integrations\N8n\Tools\N8nGetExecution;
use OpenCompany\Integrations\N8n\Tools\N8nListCredentials;
use OpenCompany\Integrations\N8n\Tools\N8nGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the n8n integration and its tools with the integration platform.
 *
 * Provides workflow, execution, credential, and user management tools
 * via the n8n REST API.
 */
class N8nToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'n8n';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'workflows, executions, credentials',
            'description' => 'n8n integration for workflow automation',
            'icon' => 'mdi:api',
            'logo' => 'mdi:api',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'n8n',
            'description' => 'Manage workflows, executions, credentials, and users on n8n.',
            'icon' => 'mdi:api',
            'logo' => 'mdi:api',
            'category' => 'productivity',
            'docs_url' => 'https://docs.n8n.io/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'n8n_api_...',
                'hint' => 'Generate an API key in your n8n instance at <strong>Settings → API → Create API Key</strong>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.n8n.io/v1/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = ($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? '');
                $name = trim($name) ?: ($user['email'] ?? 'unknown');

                return [
                    'success' => true,
                    'message' => "Connected to n8n as {$name}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'n8n API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'n8n_list_workflows' => [
                'class' => N8nListWorkflows::class,
                'type' => 'read',
                'name' => 'List Workflows',
                'description' => 'List n8n workflows.',
                'icon' => 'mdi:sitemap-outline',
            ],
            'n8n_get_workflow' => [
                'class' => N8nGetWorkflow::class,
                'type' => 'read',
                'name' => 'Get Workflow',
                'description' => 'Get details for a specific n8n workflow.',
                'icon' => 'mdi:sitemap-outline',
            ],
            'n8n_create_workflow' => [
                'class' => N8nCreateWorkflow::class,
                'type' => 'write',
                'name' => 'Create Workflow',
                'description' => 'Create a new n8n workflow.',
                'icon' => 'mdi:sitemap-plus-outline',
            ],
            'n8n_list_executions' => [
                'class' => N8nListExecutions::class,
                'type' => 'read',
                'name' => 'List Executions',
                'description' => 'List n8n workflow executions.',
                'icon' => 'mdi:play-circle-outline',
            ],
            'n8n_get_execution' => [
                'class' => N8nGetExecution::class,
                'type' => 'read',
                'name' => 'Get Execution',
                'description' => 'Get details for a specific n8n execution.',
                'icon' => 'mdi:play-circle-outline',
            ],
            'n8n_list_credentials' => [
                'class' => N8nListCredentials::class,
                'type' => 'read',
                'name' => 'List Credentials',
                'description' => 'List n8n credentials.',
                'icon' => 'mdi:key-outline',
            ],
            'n8n_get_current_user' => [
                'class' => N8nGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated n8n user\'s profile.',
                'icon' => 'mdi:account-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/n8n.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new N8nService(
                apiKey: $creds->get('n8n', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(N8nService::class));
    }
}
