<?php

namespace OpenCompany\Integrations\Directus;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Directus\Tools\DirectusCreateItem;
use OpenCompany\Integrations\Directus\Tools\DirectusDeleteItem;
use OpenCompany\Integrations\Directus\Tools\DirectusGetCurrentUser;
use OpenCompany\Integrations\Directus\Tools\DirectusGetItem;
use OpenCompany\Integrations\Directus\Tools\DirectusListCollections;
use OpenCompany\Integrations\Directus\Tools\DirectusListItems;
use OpenCompany\Integrations\Directus\Tools\DirectusUpdateItem;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class DirectusToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'directus';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'collections, items, CRUD',
            'description' => 'Headless CMS & data platform',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:directus',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Directus',
            'description' => 'Open-source headless CMS and data platform for managing SQL databases via REST API.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:directus',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.directus.io/reference/introduction.html',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Directus access token',
                'hint' => 'Generate a static token in <strong>Settings → Access Tokens</strong> or use your user\'s temporary token.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Instance URL',
                'placeholder' => 'https://your-directus.example.com',
                'hint' => 'The base URL of your Directus instance (no trailing slash).',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No instance URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json('data');

                return [
                    'success' => true,
                    'message' => "Connected to Directus at {$baseUrl}" . ($user ? " as {$user['email']}" : '') . '.',
                ];
            }

            $error = $response->json('errors.0.message') ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Directus returned an error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => "Could not reach Directus at {$baseUrl}: {$e->getMessage()}"];
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
            'directus_list_items' => [
                'class' => DirectusListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items in a Directus collection with filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'directus_get_item' => [
                'class' => DirectusGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Retrieve a single item from a Directus collection by ID.',
                'icon' => 'ph:eye',
            ],
            'directus_create_item' => [
                'class' => DirectusCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item in a Directus collection.',
                'icon' => 'ph:plus',
            ],
            'directus_update_item' => [
                'class' => DirectusUpdateItem::class,
                'type' => 'write',
                'name' => 'Update Item',
                'description' => 'Update an existing item in a Directus collection.',
                'icon' => 'ph:pencil',
            ],
            'directus_delete_item' => [
                'class' => DirectusDeleteItem::class,
                'type' => 'write',
                'name' => 'Delete Item',
                'description' => 'Delete an item from a Directus collection.',
                'icon' => 'ph:trash',
            ],
            'directus_list_collections' => [
                'class' => DirectusListCollections::class,
                'type' => 'read',
                'name' => 'List Collections',
                'description' => 'List all available collections in the Directus instance.',
                'icon' => 'ph:folders',
            ],
            'directus_get_current_user' => [
                'class' => DirectusGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated Directus user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/directus.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Instance URL', 'required' => true],
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

            $service = new DirectusService(
                accessToken: $creds->get('directus', 'access_token', '', $account),
                baseUrl: $creds->get('directus', 'url', 'https://directus.example.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(DirectusService::class));
    }
}
