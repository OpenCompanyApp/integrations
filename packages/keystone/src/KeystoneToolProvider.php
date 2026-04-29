<?php

namespace OpenCompany\Integrations\Keystone;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Keystone\Tools\KeystoneCreateItem;
use OpenCompany\Integrations\Keystone\Tools\KeystoneGetCurrentUser;
use OpenCompany\Integrations\Keystone\Tools\KeystoneGetItem;
use OpenCompany\Integrations\Keystone\Tools\KeystoneGetList;
use OpenCompany\Integrations\Keystone\Tools\KeystoneListItems;
use OpenCompany\Integrations\Keystone\Tools\KeystoneListLists;
use OpenCompany\Integrations\Keystone\Tools\KeystoneListUsers;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class KeystoneToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'keystone';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'KeystoneJS',
            'description' => 'KeystoneJS headless CMS & data platform',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:keystonejs',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'KeystoneJS',
            'description' => 'Headless CMS and data platform for managing content and data via REST API.',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:keystonejs',
            'category' => 'data',
            'badge' => 'New',
            'docs_url' => 'https://keystonejs.com/docs/graphql/overview',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Keystone API access token',
                'hint' => 'Generate a token from your KeystoneJS admin UI or use your authentication provider token.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.keystonejs.com/v1',
                'hint' => 'The base URL of your KeystoneJS REST API (no trailing slash).',
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
            return ['success' => false, 'error' => 'No API base URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json('data') ?? $response->json();

                $name = is_array($user) ? ($user['name'] ?? $user['email'] ?? 'Unknown') : 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to KeystoneJS at {$baseUrl} as {$name}.",
                ];
            }

            $error = $response->json('errors.0.message') ?? "HTTP {$response->status()}";

            return [
                'success' => false,
                'error' => "Keystone returned an error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => "Could not reach Keystone at {$baseUrl}: {$e->getMessage()}"];
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
            'keystone_list_lists' => [
                'class' => KeystoneListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all available lists (collections) in the KeystoneJS instance.',
                'icon' => 'ph:folders',
            ],
            'keystone_get_list' => [
                'class' => KeystoneGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get metadata and schema for a specific KeystoneJS list.',
                'icon' => 'ph:folder-open',
            ],
            'keystone_list_items' => [
                'class' => KeystoneListItems::class,
                'type' => 'read',
                'name' => 'List Items',
                'description' => 'List items in a KeystoneJS list with filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'keystone_get_item' => [
                'class' => KeystoneGetItem::class,
                'type' => 'read',
                'name' => 'Get Item',
                'description' => 'Retrieve a single item from a KeystoneJS list by ID.',
                'icon' => 'ph:eye',
            ],
            'keystone_create_item' => [
                'class' => KeystoneCreateItem::class,
                'type' => 'write',
                'name' => 'Create Item',
                'description' => 'Create a new item in a KeystoneJS list.',
                'icon' => 'ph:plus',
            ],
            'keystone_list_users' => [
                'class' => KeystoneListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users in the KeystoneJS instance.',
                'icon' => 'ph:users',
            ],
            'keystone_get_current_user' => [
                'class' => KeystoneGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated KeystoneJS user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/keystone.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
            $creds = app(CredentialResolver::class);

            $service = new KeystoneService(
                accessToken: $creds->get('keystone', 'access_token', '', $account),
                baseUrl: $creds->get('keystone', 'url', 'https://api.keystonejs.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(KeystoneService::class));
    }
}
