<?php

namespace OpenCompany\Integrations\Vercel;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vercel\Tools\VercelListDeployments;
use OpenCompany\Integrations\Vercel\Tools\VercelGetDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelListProjects;
use OpenCompany\Integrations\Vercel\Tools\VercelGetProject;
use OpenCompany\Integrations\Vercel\Tools\VercelCreateDeployment;
use OpenCompany\Integrations\Vercel\Tools\VercelListDomains;
use OpenCompany\Integrations\Vercel\Tools\VercelGetCurrentUser;

class VercelToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'vercel';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'deployments, projects, domains',
            'description' => 'Deployment & hosting platform',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:vercel',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Vercel',
            'description' => 'Deploy and manage web applications, view deployments, projects, and domains',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:vercel',
            'category' => 'devtools',
            'badge' => 'verified',
            'docs_url' => 'https://vercel.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Vercel access token',
                'hint' => 'Generate a token in your Vercel account under Settings → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.vercel.com',
                'hint' => 'Use <code>https://api.vercel.com</code> for Vercel Cloud, or a custom endpoint',
                'default' => 'https://api.vercel.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.vercel.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v2/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Vercel API at {$baseUrl}. Check the URL.",
                ];
            }

            $username = $json['user']['username'] ?? $json['user']['name'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Vercel API as {$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'vercel_list_deployments' => [
                'class' => VercelListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List deployments across projects or for a specific project.',
                'icon' => 'ph:list-bullets',
            ],
            'vercel_get_deployment' => [
                'class' => VercelGetDeployment::class,
                'type' => 'read',
                'name' => 'Get Deployment',
                'description' => 'Get details for a specific deployment by ID.',
                'icon' => 'ph:rocket',
            ],
            'vercel_list_projects' => [
                'class' => VercelListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Vercel projects.',
                'icon' => 'ph:folder',
            ],
            'vercel_get_project' => [
                'class' => VercelGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details for a specific Vercel project.',
                'icon' => 'ph:folder-open',
            ],
            'vercel_create_deployment' => [
                'class' => VercelCreateDeployment::class,
                'type' => 'write',
                'name' => 'Create Deployment',
                'description' => 'Create a new deployment for a project.',
                'icon' => 'ph:cloud-arrow-up',
            ],
            'vercel_list_domains' => [
                'class' => VercelListDomains::class,
                'type' => 'read',
                'name' => 'List Domains',
                'description' => 'List domains for a Vercel project.',
                'icon' => 'ph:globe',
            ],
            'vercel_get_current_user' => [
                'class' => VercelGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Vercel user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/vercel.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vercel.com'],
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

            $service = new VercelService(
                accessToken: $creds->get('vercel', 'access_token', '', $account),
                baseUrl: $creds->get('vercel', 'base_url', 'https://api.vercel.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(VercelService::class));
    }
}
