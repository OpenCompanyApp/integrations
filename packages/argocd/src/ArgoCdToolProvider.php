<?php

namespace OpenCompany\Integrations\ArgoCd;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdListApplications;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdGetApplication;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdCreateApplication;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdListProjects;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdGetProject;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdListRepositories;
use OpenCompany\Integrations\ArgoCd\Tools\ArgoCdGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the Argo CD integration and its tools with the integration platform.
 *
 * Provides application, project, and repository management tools
 * via the Argo CD GitOps API.
 */
class ArgoCdToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'argocd';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'applications, projects, repositories',
            'description' => 'Argo CD GitOps integration for Kubernetes application delivery',
            'icon' => 'mdi:kubernetes',
            'logo' => 'mdi:kubernetes',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Argo CD',
            'description' => 'Manage GitOps applications, projects, and repositories on Argo CD for Kubernetes continuous delivery.',
            'icon' => 'mdi:kubernetes',
            'logo' => 'mdi:kubernetes',
            'category' => 'productivity',
            'docs_url' => 'https://argo-cd.readthedocs.io/en/stable/operator-manual/server-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Bearer Token',
                'placeholder' => 'eyJhbGciOi...',
                'hint' => 'Generate an access token in <strong>Argo CD → User Settings → Generate New Token</strong>, or use the <code>argocd account generate-token</code> CLI command.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'API Base URL',
                'placeholder' => 'https://argocd.example.com/api/v1',
                'hint' => 'The full base URL of your Argo CD server API. Defaults to <code>https://api.argocd.io/v1</code> if left empty.',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $token = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.argocd.io/v1', '/');

        if (empty($token)) {
            return ['success' => false, 'error' => 'No Bearer token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$token}",
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/session/userinfo');

            if ($response->successful()) {
                $data = $response->json();
                $username = $data['username'] ?? $data['loggedIn'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Argo CD as {$username}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $body['error'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Argo CD API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'argocd_list_applications' => [
                'class' => ArgoCdListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List all Argo CD applications.',
                'icon' => 'mdi:application-outline',
            ],
            'argocd_get_application' => [
                'class' => ArgoCdGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get details for a specific Argo CD application.',
                'icon' => 'mdi:application-outline',
            ],
            'argocd_create_application' => [
                'class' => ArgoCdCreateApplication::class,
                'type' => 'write',
                'name' => 'Create Application',
                'description' => 'Create a new Argo CD application.',
                'icon' => 'mdi:application-plus-outline',
            ],
            'argocd_list_projects' => [
                'class' => ArgoCdListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Argo CD projects.',
                'icon' => 'mdi:folder-outline',
            ],
            'argocd_get_project' => [
                'class' => ArgoCdGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Argo CD project.',
                'icon' => 'mdi:folder-outline',
            ],
            'argocd_list_repositories' => [
                'class' => ArgoCdListRepositories::class,
                'type' => 'read',
                'name' => 'List Repositories',
                'description' => 'List all configured Git repositories in Argo CD.',
                'icon' => 'mdi:source-repository',
            ],
            'argocd_get_current_user' => [
                'class' => ArgoCdGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Argo CD user\'s profile.',
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
        return dirname(__DIR__) . '/lua-docs/argocd.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'API Base URL', 'required' => false],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ArgoCdService(
                token: $creds->get('argocd', 'api_key', '', $account),
                baseUrl: $creds->get('argocd', 'base_url', 'https://api.argocd.io/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(ArgoCdService::class));
    }
}
