<?php

namespace OpenCompany\Integrations\Ghost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ghost\Tools\GhostCreatePost;
use OpenCompany\Integrations\Ghost\Tools\GhostGetCurrentUser;
use OpenCompany\Integrations\Ghost\Tools\GhostGetPost;
use OpenCompany\Integrations\Ghost\Tools\GhostListMembers;
use OpenCompany\Integrations\Ghost\Tools\GhostListPages;
use OpenCompany\Integrations\Ghost\Tools\GhostListPosts;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdatePost;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class GhostToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'ghost';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'posts, pages, members, blog, cms',
            'description' => 'Ghost CMS content management',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:ghost',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ghost CMS',
            'description' => 'Publish and manage blog posts, pages, and members on Ghost',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:ghost',
            'category' => 'cms',
            'badge' => 'New',
            'docs_url' => 'https://ghost.org/docs/admin-api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Admin API Key',
                'placeholder' => 'Enter your Ghost Admin API key',
                'hint' => 'Generate an Admin API key in Ghost Admin → Settings → Integrations → Custom Integration → Add API Key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://yoursite.ghost.io/ghost/api/admin',
                'hint' => 'Your Ghost Admin API URL. For Ghost(Pro) use <code>https://yoursite.ghost.io/ghost/api/admin</code>. For self-hosted, use <code>https://yourdomain.com/ghost/api/admin</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No Admin API key provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No API base URL provided.'];
        }

        try {
            $service = new GhostService($apiKey, $baseUrl);
            $user = $service->getCurrentUser();

            if (isset($user['users'][0]['name'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Ghost as {$user['users'][0]['name']}.",
                ];
            }

            return ['success' => true, 'message' => 'Connected to Ghost API.'];
        } catch (\Exception $e) {
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
            'ghost_list_posts' => [
                'class' => GhostListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List blog posts with filtering, pagination, and ordering.',
                'icon' => 'ph:list',
            ],
            'ghost_get_post' => [
                'class' => GhostGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a single blog post by ID.',
                'icon' => 'ph:article',
            ],
            'ghost_create_post' => [
                'class' => GhostCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new blog post with title, content, status, and tags.',
                'icon' => 'ph:plus',
            ],
            'ghost_update_post' => [
                'class' => GhostUpdatePost::class,
                'type' => 'write',
                'name' => 'Update Post',
                'description' => 'Update an existing blog post.',
                'icon' => 'ph:pencil',
            ],
            'ghost_list_pages' => [
                'class' => GhostListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List static pages with filtering and pagination.',
                'icon' => 'ph:files',
            ],
            'ghost_list_members' => [
                'class' => GhostListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List newsletter members with filtering and pagination.',
                'icon' => 'ph:users',
            ],
            'ghost_get_current_user' => [
                'class' => GhostGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Ghost admin user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ghost.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Admin API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => true],
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

            $service = new GhostService(
                apiKey: $creds->get('ghost', 'api_key', '', $account),
                baseUrl: $creds->get('ghost', 'url', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(GhostService::class));
    }
}
