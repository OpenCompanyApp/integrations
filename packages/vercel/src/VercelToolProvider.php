<?php

namespace OpenCompany\Integrations\Vercel;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vercel\Tools\VercelGetCurrentUser;
use OpenCompany\Integrations\Vercel\Tools\VercelGetDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelGetProject;
use OpenCompany\Integrations\Vercel\Tools\VercelListDeployments;
use OpenCompany\Integrations\Vercel\Tools\VercelListDomains;
use OpenCompany\Integrations\Vercel\Tools\VercelListProjects;
use OpenCompany\Integrations\Vercel\Tools\VercelListTeams;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
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
            'category' => 'productivity',
            'badge' => 'Official',
            'docs_url' => 'https://vercel.com/docs/api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'name' => 'token',
                'label' => 'Vercel API Token',
                'type' => 'password',
                'required' => true,
                'description' => 'A Vercel API token (Bearer token) with the required scopes.',
                'docs_link' => 'https://vercel.com/account/tokens',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        try {
            $service = new VercelService(token: $config['token'] ?? '');
            $user = $service->getCurrentUser();

            if (isset($user['user'])) {
                return ['success' => true, 'message' => "Connected as {$user['user']['username']}"];
            }

            return ['success' => false, 'message' => 'Unexpected response from Vercel API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'token' => ['required', 'string', 'min:1'],
        ];
    }

    /* ---------- ToolProvider ---------- */

    public function tools(): array
    {
        return [
            'vercel_list_projects' => [
                'class' => VercelListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Vercel projects.',
                'icon' => 'ph:folder-bold',
            ],
            'vercel_get_project' => [
                'class' => VercelGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Vercel project.',
                'icon' => 'ph:folder-open-bold',
            ],
            'vercel_list_deployments' => [
                'class' => VercelListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List deployments across your Vercel projects.',
                'icon' => 'ph:rocket-launch-bold',
            ],
            'vercel_get_deployment' => [
                'class' => VercelGetDeployment::class,
                'type' => 'read',
                'name' => 'Get Deployment',
                'description' => 'Get details for a specific Vercel deployment.',
                'icon' => 'ph:rocket-bold',
            ],
            'vercel_list_domains' => [
                'class' => VercelListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List all domains configured in Vercel.',
                'icon' => 'ph:globe-bold',
            ],
            'vercel_list_teams' => [
                'class' => VercelListTeams::class,
                'type' => 'read',
                'name' => 'List Teams',
                'description' => 'List all Vercel teams you belong to.',
                'icon' => 'ph:users-three-bold',
            ],
            'vercel_get_current_user' => [
                'class' => VercelGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Vercel user profile.',
                'icon' => 'ph:user-bold',
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
    }    public function credentialFields(): array
    {
        return [
            'token' => 'Vercel API Token',
        ];
    }

    /* ---------- internal ---------- */

    private function resolveService(array $context = []): VercelService
    {
        if (! empty($context['account'])) {
            $creds = app(CredentialResolver::class);
            return new VercelService(token: $creds->get('vercel', 'token', '', $context['account']));
        }

        return app(VercelService::class);
    }
}
