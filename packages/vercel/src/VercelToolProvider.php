<?php

namespace OpenCompany\Integrations\Vercel;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vercel\Tools\VercelCreateDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelGetCurrentUser;
use OpenCompany\Integrations\Vercel\Tools\VercelGetDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelGetProject;
use OpenCompany\Integrations\Vercel\Tools\VercelListDeployments;
use OpenCompany\Integrations\Vercel\Tools\VercelListDomains;
use OpenCompany\Integrations\Vercel\Tools\VercelListProjects;
use OpenCompany\Integrations\Vercel\Tools\VercelListTeams;

/**
 * Exposes Vercel REST API tools to host applications.
 *
 * Handles catalog metadata, credential setup, connection checks, and
 * multi-account service resolution for Vercel.
 */
class VercelToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'vercel';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Vercel',
            'description' => 'Deployments, projects, domains, and team management on Vercel.',
            'icon' => 'ph:cloud-arrow-up-bold',
            'logo' => 'simple-icons:vercel',
        ];
    }

    /* ---------- ConfigurableIntegration ---------- */

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vercel',
            'description' => 'Manage your Vercel projects, deployments, domains, and teams.',
            'icon' => 'ph:cloud-arrow-up-bold',
            'logo' => 'simple-icons:vercel',
            'category' => 'data',
            'badge' => 'Official',
            'docs_url' => 'https://vercel.com/docs/api',
            'source_url' => 'https://vercel.com/docs/rest-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'token',
                'label' => 'Vercel API Token',
                'type' => 'secret',
                'required' => true,
                'description' => 'A Vercel API token (Bearer token) with the required scopes.',
                'docs_link' => 'https://vercel.com/account/tokens',
            ],
        ];
    }

    /**
     * Verify Vercel credentials with a lightweight current-user request.
     *
     * @param  array<string, mixed>  $config  Credential form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $service = new VercelService(
                token: $config['token'] ?? '',
                baseUrl: $config['url'] ?? 'https://api.vercel.com',
            );
            $user = $service->getCurrentUser();

            if (isset($user['user'])) {
                return ['success' => true, 'message' => "Connected as {$user['user']['username']}"];
            }

            return ['success' => false, 'error' => 'Unexpected response from Vercel API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'token' => ['required', 'string', 'min:1'],
            'url' => ['nullable', 'url'],
        ];
    }

    /* ---------- ToolProvider ---------- */

    public function tools(): array
    {
        return [
            'vercel_create_deployment' => [
                'class' => VercelCreateDeployment::class,
                'type' => 'write',
                'name' => 'Create Deployment',
                'description' => 'Create a new Vercel deployment using files or a Git source.',
                'icon' => 'ph:cloud-arrow-up',
            ],
            'vercel_get_current_user' => [
                'class' => VercelGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Vercel user profile, including username, email, and plan.',
                'icon' => 'ph:wrench',
            ],
            'vercel_get_deployment' => [
                'class' => VercelGetDeployment::class,
                'type' => 'read',
                'name' => 'Get Deployment',
                'description' => 'Get details for a specific Vercel deployment by ID, including status, URL, and build logs.',
                'icon' => 'ph:wrench',
            ],
            'vercel_get_project' => [
                'class' => VercelGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Vercel project by ID, including framework, domains, and settings.',
                'icon' => 'ph:wrench',
            ],
            'vercel_list_deployments' => [
                'class' => VercelListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List deployments across your Vercel projects. Filter by project, state, or target.',
                'icon' => 'ph:wrench',
            ],
            'vercel_list_domains' => [
                'class' => VercelListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains configured in Vercel, including verification and DNS status.',
                'icon' => 'ph:wrench',
            ],
            'vercel_list_projects' => [
                'class' => VercelListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Vercel projects. Returns project names, IDs, framework, and deployment status.',
                'icon' => 'ph:wrench',
            ],
            'vercel_list_teams' => [
                'class' => VercelListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Vercel teams you belong to, including membership roles and member counts.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vercel.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'token', 'type' => 'secret', 'label' => 'Vercel API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vercel.com'],
        ];
    }

    /* ---------- internal ---------- */

    private function resolveService(array $context = []): VercelService
    {
        if (! empty($context['account'])) {
            $creds = app(CredentialResolver::class);
            return new VercelService(
                token: $creds->get('vercel', 'token', '', $context['account']),
                baseUrl: $creds->get('vercel', 'url', 'https://api.vercel.com', $context['account']),
            );
        }

        return app(VercelService::class);
    }
}
