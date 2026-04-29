<?php

namespace OpenCompany\Integrations\Raindrop;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Raindrop\Tools\RaindropListBookmarks;
use OpenCompany\Integrations\Raindrop\Tools\RaindropGetBookmark;
use OpenCompany\Integrations\Raindrop\Tools\RaindropCreateBookmark;
use OpenCompany\Integrations\Raindrop\Tools\RaindropUpdateBookmark;
use OpenCompany\Integrations\Raindrop\Tools\RaindropListCollections;
use OpenCompany\Integrations\Raindrop\Tools\RaindropGetCollection;
use OpenCompany\Integrations\Raindrop\Tools\RaindropGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RaindropToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'raindrop';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Raindrop.io',
            'description' => 'Bookmark manager',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'simple-icons:raindropio',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Raindrop.io',
            'description' => 'All-in-one bookmark manager — save, organize, and search bookmarks',
            'icon' => 'ph:bookmark-simple',
            'logo' => 'simple-icons:raindropio',
            'category' => 'bookmarks',
            'badge' => 'verified',
            'docs_url' => 'https://developer.raindrop.io/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Raindrop.io access token',
                'hint' => 'Generate an access token in your Raindrop.io account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.raindrop.io/rest/v1',
                'hint' => 'The Raindrop.io REST API base URL. Change only if using a custom endpoint.',
                'default' => 'https://api.raindrop.io/rest/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.raindrop.io/rest/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Raindrop API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['errorMessage'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "Raindrop API error: {$error}",
                ];
            }

            $user = $json['user'] ?? [];
            $name = trim(($user['fullName'] ?? '') . ' (' . ($user['email'] ?? '') . ')');

            return [
                'success' => true,
                'message' => "Connected to Raindrop.io as {$name}.",
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
            'raindrop_list_bookmarks' => [
                'class' => RaindropListBookmarks::class,
                'type' => 'read',
                'name' => 'List Bookmarks',
                'description' => 'List bookmarks with optional collection and search filters.',
                'icon' => 'ph:list',
            ],
            'raindrop_get_bookmark' => [
                'class' => RaindropGetBookmark::class,
                'type' => 'read',
                'name' => 'Get Bookmark',
                'description' => 'Get a single bookmark by ID.',
                'icon' => 'ph:bookmark-simple',
            ],
            'raindrop_create_bookmark' => [
                'class' => RaindropCreateBookmark::class,
                'type' => 'write',
                'name' => 'Create Bookmark',
                'description' => 'Save a new bookmark with optional title, tags, and collection.',
                'icon' => 'ph:plus',
            ],
            'raindrop_update_bookmark' => [
                'class' => RaindropUpdateBookmark::class,
                'type' => 'write',
                'name' => 'Update Bookmark',
                'description' => 'Update an existing bookmark\'s fields.',
                'icon' => 'ph:pencil-simple',
            ],
            'raindrop_list_collections' => [
                'class' => RaindropListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all bookmark collections.',
                'icon' => 'ph:folder',
            ],
            'raindrop_get_collection' => [
                'class' => RaindropGetCollection::class,
                'type' => 'read',
                'name' => 'Get Collection',
                'description' => 'Get details of a specific collection.',
                'icon' => 'ph:folder-open',
            ],
            'raindrop_get_current_user' => [
                'class' => RaindropGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/raindrop.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.raindrop.io/rest/v1'],
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

            $service = new RaindropService(
                accessToken: $creds->get('raindrop', 'access_token', '', $account),
                baseUrl: $creds->get('raindrop', 'url', 'https://api.raindrop.io/rest/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RaindropService::class));
    }
}
