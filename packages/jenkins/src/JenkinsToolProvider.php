<?php

namespace OpenCompany\Integrations\Jenkins;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsListJobs;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsGetJob;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsCreateJob;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsListBuilds;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsGetBuild;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsListNodes;
use OpenCompany\Integrations\Jenkins\Tools\JenkinsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the Jenkins integration and its tools with the integration platform.
 *
 * Provides job, build, node, and user management tools via the Jenkins REST API.
 */
class JenkinsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
        return 'jenkins';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Jenkins',
            'description' => 'Jenkins CI/CD integration for continuous integration and delivery',
            'icon' => 'mdi:pipe',
            'logo' => 'mdi:pipe',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Jenkins',
            'description' => 'Manage Jenkins CI/CD jobs, builds, nodes, and user information.',
            'icon' => 'mdi:pipe',
            'logo' => 'mdi:pipe',
            'category' => 'productivity',
            'docs_url' => 'https://www.jenkins.io/doc/book/using/remote-access-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => '11a2b3c4d5e...',
                'hint' => 'Generate an API token at <a href="https://www.jenkins.io/me/configure" target="_blank">Jenkins → User → Configure → API Token</a>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiToken}",
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.jenkins.io/v1/user');

            if ($response->successful()) {
                $user = $response->json();
                $id = $user['id'] ?? $user['fullName'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Jenkins as {$id}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Jenkins API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'jenkins_list_jobs' => [
                'class' => JenkinsListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List all Jenkins jobs.',
                'icon' => 'mdi:briefcase-outline',
            ],
            'jenkins_get_job' => [
                'class' => JenkinsGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get details for a specific Jenkins job.',
                'icon' => 'mdi:briefcase-outline',
            ],
            'jenkins_create_job' => [
                'class' => JenkinsCreateJob::class,
                'type' => 'write',
                'name' => 'Create Job',
                'description' => 'Create a new Jenkins job.',
                'icon' => 'mdi:briefcase-plus-outline',
            ],
            'jenkins_list_builds' => [
                'class' => JenkinsListBuilds::class,
                'type' => 'read',
                'name' => 'List Builds',
                'description' => 'List builds for a specific Jenkins job.',
                'icon' => 'mdi:hammer-wrench',
            ],
            'jenkins_get_build' => [
                'class' => JenkinsGetBuild::class,
                'type' => 'read',
                'name' => 'Get Build',
                'description' => 'Get details for a specific build.',
                'icon' => 'mdi:hammer-wrench',
            ],
            'jenkins_list_nodes' => [
                'class' => JenkinsListNodes::class,
                'type' => 'read',
                'name' => 'List Nodes',
                'description' => 'List all Jenkins nodes (agents).',
                'icon' => 'mdi:server',
            ],
            'jenkins_get_current_user' => [
                'class' => JenkinsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Jenkins user\'s profile.',
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
        return dirname(__DIR__) . '/lua-docs/jenkins.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new JenkinsService(
                apiToken: $creds->get('jenkins', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(JenkinsService::class));
    }
}
