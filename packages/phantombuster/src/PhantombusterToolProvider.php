<?php

namespace OpenCompany\Integrations\Phantombuster;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterApiDelete;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterApiGet;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterApiPost;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterApiPut;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterDeleteAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterDeleteScript;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterFetchAgentOutput;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterFetchContainerOutput;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterFetchContainerResultObject;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetContainer;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetCurrentUser;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetIpLocation;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetOrganization;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterGetScript;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterLaunchAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListAgents;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListBranches;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListContainers;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListDeletedAgents;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterListScripts;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterSaveAgent;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterSaveScript;
use OpenCompany\Integrations\Phantombuster\Tools\PhantombusterStopAgent;

/**
 * Tool catalog and setup metadata for the Phantombuster integration.
 *
 * Exposes agents, containers, scripts, organization metadata, and generic
 * relative API helpers.
 */
class PhantombusterToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'phantombuster';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Phantombuster',
            'description' => 'Automation & scraping',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:phantombuster',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Phantombuster',
            'description' => 'Automated lead generation and web scraping platform',
            'icon' => 'ph:robot',
            'logo' => 'simple-icons:phantombuster',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.phantombuster.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Phantombuster API key',
                'hint' => 'Find your API key in Phantombuster under <strong>Settings > API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.phantombuster.com/api/v2',
                'hint' => 'Override only if using a custom endpoint. Default: <code>https://api.phantombuster.com/api/v2</code>',
                'default' => 'https://api.phantombuster.com/api/v2',
            ],
        ];
    }

    /**
     * Verify Phantombuster credentials with a lightweight user request.
     *
     * @param  array<string, mixed>  $config  Candidate integration config.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.phantombuster.com/api/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Phantombuster-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Phantombuster API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? 'Unknown error';

                return [
                    'success' => false,
                    'error' => "Authentication failed: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Phantombuster API as ' . ($json['email'] ?? 'the authenticated user') . '.',
            ];
        } catch (\Throwable $e) {
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
            'phantombuster_list_agents' => [
                'class' => PhantombusterListAgents::class,
                'type' => 'read',
                'name' => 'List Agents',
                'description' => 'List all Phantombuster agents in your account.',
                'icon' => 'ph:list',
            ],
            'phantombuster_get_agent' => [
                'class' => PhantombusterGetAgent::class,
                'type' => 'read',
                'name' => 'Get Agent',
                'description' => 'Get details for a specific Phantombuster agent.',
                'icon' => 'ph:robot',
            ],
            'phantombuster_launch_agent' => [
                'class' => PhantombusterLaunchAgent::class,
                'type' => 'write',
                'name' => 'Launch Agent',
                'description' => 'Launch a Phantombuster agent to start an automation.',
                'icon' => 'ph:play',
            ],
            'phantombuster_save_agent' => [
                'class' => PhantombusterSaveAgent::class,
                'type' => 'write',
                'name' => 'Save Agent',
                'description' => 'Create or update a Phantombuster agent.',
                'icon' => 'ph:floppy-disk',
            ],
            'phantombuster_stop_agent' => [
                'class' => PhantombusterStopAgent::class,
                'type' => 'write',
                'name' => 'Stop Agent',
                'description' => 'Stop a running Phantombuster agent.',
                'icon' => 'ph:stop',
            ],
            'phantombuster_delete_agent' => [
                'class' => PhantombusterDeleteAgent::class,
                'type' => 'write',
                'name' => 'Delete Agent',
                'description' => 'Delete a Phantombuster agent.',
                'icon' => 'ph:trash',
            ],
            'phantombuster_list_deleted_agents' => [
                'class' => PhantombusterListDeletedAgents::class,
                'type' => 'read',
                'name' => 'List Deleted Agents',
                'description' => 'List deleted Phantombuster agents.',
                'icon' => 'ph:archive',
            ],
            'phantombuster_fetch_agent_output' => [
                'class' => PhantombusterFetchAgentOutput::class,
                'type' => 'read',
                'name' => 'Fetch Agent Output',
                'description' => 'Fetch incremental output from the latest relevant agent container.',
                'icon' => 'ph:terminal-window',
            ],
            'phantombuster_list_containers' => [
                'class' => PhantombusterListContainers::class,
                'type' => 'read',
                'name' => 'List Containers',
                'description' => 'List all Phantombuster containers (execution history).',
                'icon' => 'ph:list',
            ],
            'phantombuster_get_container' => [
                'class' => PhantombusterGetContainer::class,
                'type' => 'read',
                'name' => 'Get Container',
                'description' => 'Get details for a specific Phantombuster container.',
                'icon' => 'ph:cube',
            ],
            'phantombuster_fetch_container_output' => [
                'class' => PhantombusterFetchContainerOutput::class,
                'type' => 'read',
                'name' => 'Fetch Container Output',
                'description' => 'Fetch JSON or raw output for a container.',
                'icon' => 'ph:file-text',
            ],
            'phantombuster_fetch_container_result_object' => [
                'class' => PhantombusterFetchContainerResultObject::class,
                'type' => 'read',
                'name' => 'Fetch Container Result Object',
                'description' => 'Fetch the result object for a container.',
                'icon' => 'ph:brackets-curly',
            ],
            'phantombuster_list_scripts' => [
                'class' => PhantombusterListScripts::class,
                'type' => 'read',
                'name' => 'List Scripts',
                'description' => 'List Phantombuster scripts.',
                'icon' => 'ph:code',
            ],
            'phantombuster_get_script' => [
                'class' => PhantombusterGetScript::class,
                'type' => 'read',
                'name' => 'Get Script',
                'description' => 'Get a Phantombuster script.',
                'icon' => 'ph:code',
            ],
            'phantombuster_save_script' => [
                'class' => PhantombusterSaveScript::class,
                'type' => 'write',
                'name' => 'Save Script',
                'description' => 'Create or update a Phantombuster script.',
                'icon' => 'ph:floppy-disk',
            ],
            'phantombuster_delete_script' => [
                'class' => PhantombusterDeleteScript::class,
                'type' => 'write',
                'name' => 'Delete Script',
                'description' => 'Delete a Phantombuster script.',
                'icon' => 'ph:trash',
            ],
            'phantombuster_list_branches' => [
                'class' => PhantombusterListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List Phantombuster script branches.',
                'icon' => 'ph:git-branch',
            ],
            'phantombuster_get_organization' => [
                'class' => PhantombusterGetOrganization::class,
                'type' => 'read',
                'name' => 'Get Organization',
                'description' => 'Get current Phantombuster organization metadata.',
                'icon' => 'ph:buildings',
            ],
            'phantombuster_get_ip_location' => [
                'class' => PhantombusterGetIpLocation::class,
                'type' => 'read',
                'name' => 'Get IP Location',
                'description' => 'Resolve country metadata for an IP address.',
                'icon' => 'ph:map-pin',
            ],
            'phantombuster_get_current_user' => [
                'class' => PhantombusterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Phantombuster user profile.',
                'icon' => 'ph:user',
            ],
            'phantombuster_api_get' => [
                'class' => PhantombusterApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call a relative Phantombuster API GET endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'phantombuster_api_post' => [
                'class' => PhantombusterApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call a relative Phantombuster API POST endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'phantombuster_api_put' => [
                'class' => PhantombusterApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call a relative Phantombuster API PUT endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
            'phantombuster_api_delete' => [
                'class' => PhantombusterApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call a relative Phantombuster API DELETE endpoint.',
                'icon' => 'ph:brackets-curly',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/phantombuster.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.phantombuster.com/api/v2'],
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
            $creds = app(CredentialResolver::class);

            $service = new PhantombusterService(
                apiKey: $creds->get('phantombuster', 'api_key', '', $account),
                baseUrl: $creds->get('phantombuster', 'url', 'https://api.phantombuster.com/api/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(PhantombusterService::class));
    }
}
