<?php

namespace OpenCompany\Integrations\Railway;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Railway\Tools\RailwayGetCurrentUser;
use OpenCompany\Integrations\Railway\Tools\RailwayCreateProject;
use OpenCompany\Integrations\Railway\Tools\RailwayGetProject;
use OpenCompany\Integrations\Railway\Tools\RailwayGetService;
use OpenCompany\Integrations\Railway\Tools\RailwayListDeployments;
use OpenCompany\Integrations\Railway\Tools\RailwayListProjects;
use OpenCompany\Integrations\Railway\Tools\RailwayListServices;

/**
 * Tool provider for the Railway integration.
 *
 * Exposes project, service, deployment, and current-user GraphQL tools with
 * bearer-token configuration and multi-account credential resolution.
 */
class RailwayToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'railway';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Railway',
            'description' => 'Cloud hosting platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:railway',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Railway',
            'description' => 'Deploy and manage cloud projects, services, and deployments on Railway',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:railway',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.railway.com/reference/public-api/',
            'source_url' => 'https://docs.railway.com/reference/public-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Railway API token',
                'hint' => 'Generate an API token in Railway under Account Settings → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'GraphQL API URL',
                'placeholder' => 'https://backboard.railway.app/graphql/v2',
                'hint' => 'The Railway GraphQL API endpoint. Use the default unless you have a custom proxy.',
                'default' => 'https://backboard.railway.app/graphql/v2',
            ],
        ];
    }

    /**
     * Verify that the supplied Railway credentials can query the current user.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://backboard.railway.app/graphql/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl, [
                'query' => 'query { viewer { id name email } }',
            ]);

            $json = $response->json();

            if (isset($json['errors']) && !empty($json['errors'])) {
                $messages = array_map(fn ($e) => $e['message'] ?? 'Unknown error', $json['errors']);

                return ['success' => false, 'error' => implode('; ', $messages)];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Railway API at {$baseUrl}. Check the URL.",
                ];
            }

            $viewer = $json['data']['viewer'] ?? $json['data'] ?? [];
            $name = $viewer['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Railway as {$name}.",
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
            'railway_list_projects' => [
                'class' => RailwayListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Railway projects the authenticated user has access to.',
                'icon' => 'ph:folder',
            ],
            'railway_get_project' => [
                'class' => RailwayGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get detailed information about a specific Railway project.',
                'icon' => 'ph:folder-open',
            ],
            'railway_create_project' => [
                'class' => RailwayCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new Railway project.',
                'icon' => 'ph:folder-plus',
            ],
            'railway_list_services' => [
                'class' => RailwayListServices::class,
                'type' => 'read',
                'name' => 'List Services',
                'description' => 'List all services in a Railway project.',
                'icon' => 'ph:cube',
            ],
            'railway_get_service' => [
                'class' => RailwayGetService::class,
                'type' => 'read',
                'name' => 'Get Service',
                'description' => 'Get detailed information about a specific Railway service.',
                'icon' => 'ph:cube',
            ],
            'railway_list_deployments' => [
                'class' => RailwayListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List deployments for a Railway service.',
                'icon' => 'ph:rocket',
            ],
            'railway_get_current_user' => [
                'class' => RailwayGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Railway user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/railway.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'GraphQL API URL', 'required' => false, 'default' => 'https://backboard.railway.app/graphql/v2'],
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

            $service = new RailwayService(
                accessToken: $creds->get('railway', 'access_token', '', $account),
                baseUrl: $creds->get('railway', 'url', 'https://backboard.railway.app/graphql/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(RailwayService::class));
    }
}
