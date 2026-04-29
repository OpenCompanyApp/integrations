<?php

namespace OpenCompany\Integrations\Docker;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Docker\Tools\DockerListRepositories;
use OpenCompany\Integrations\Docker\Tools\DockerGetRepository;
use OpenCompany\Integrations\Docker\Tools\DockerListTags;
use OpenCompany\Integrations\Docker\Tools\DockerGetTag;
use OpenCompany\Integrations\Docker\Tools\DockerCreateRepository;
use OpenCompany\Integrations\Docker\Tools\DockerListOrganizations;
use OpenCompany\Integrations\Docker\Tools\DockerGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DockerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'docker';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Docker Hub',
            'description' => 'Container registry management',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:docker',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Docker Hub',
            'description' => 'Container image registry for managing repositories, tags, and organizations',
            'icon' => 'ph:package',
            'logo' => 'simple-icons:docker',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.docker.com/docker-hub/api/latest/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Docker Hub access token',
                'hint' => 'Generate a Personal Access Token from Docker Hub under "Account Settings > Security"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://hub.docker.com/v2',
                'hint' => 'Use <code>https://hub.docker.com/v2</code> for the default API, or a custom endpoint',
                'default' => 'https://hub.docker.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://hub.docker.com/v2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user/');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Docker Hub API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Docker Hub API as {$json['username']}.",
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
            'docker_list_repositories' => [
                'class' => DockerListRepositories::class,
                'type' => 'read',
                'name' => 'List Repositories',
                'description' => 'List Docker Hub repositories for a namespace.',
                'icon' => 'ph:folders',
            ],
            'docker_get_repository' => [
                'class' => DockerGetRepository::class,
                'type' => 'read',
                'name' => 'Get Repository',
                'description' => 'Get details for a specific Docker Hub repository.',
                'icon' => 'ph:folder',
            ],
            'docker_list_tags' => [
                'class' => DockerListTags::class,
                'type' => 'read',
                'name' => 'List Tags',
                'description' => 'List tags for a Docker Hub repository.',
                'icon' => 'ph:tag',
            ],
            'docker_get_tag' => [
                'class' => DockerGetTag::class,
                'type' => 'read',
                'name' => 'Get Tag',
                'description' => 'Get details for a specific tag in a Docker Hub repository.',
                'icon' => 'ph:tag',
            ],
            'docker_create_repository' => [
                'class' => DockerCreateRepository::class,
                'type' => 'write',
                'name' => 'Create Repository',
                'description' => 'Create a new Docker Hub repository.',
                'icon' => 'ph:plus-circle',
            ],
            'docker_list_organizations' => [
                'class' => DockerListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Docker Hub organizations the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'docker_get_current_user' => [
                'class' => DockerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Docker Hub user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/docker.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://hub.docker.com/v2'],
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

            $service = new DockerService(
                accessToken: $creds->get('docker', 'access_token', '', $account),
                baseUrl: $creds->get('docker', 'url', 'https://hub.docker.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(DockerService::class));
    }
}
