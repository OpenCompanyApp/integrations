<?php

namespace OpenCompany\Integrations\Beamer;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiDelete;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiGet;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiPost;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiPut;
use OpenCompany\Integrations\Beamer\Tools\BeamerCreatePost;
use OpenCompany\Integrations\Beamer\Tools\BeamerGetCurrentUser;
use OpenCompany\Integrations\Beamer\Tools\BeamerGetPost;
use OpenCompany\Integrations\Beamer\Tools\BeamerListCategories;
use OpenCompany\Integrations\Beamer\Tools\BeamerListComments;
use OpenCompany\Integrations\Beamer\Tools\BeamerListPosts;

/**
 * Tool provider for the Beamer changelog and notification API.
 *
 * Exposes typed post/comment/category tools plus generic API helpers for
 * Beamer endpoints that do not yet have a dedicated wrapper.
 */
class BeamerToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => [
                    'manual_secret',
                ],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
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
        return 'beamer';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Beamer',
            'description' => 'Changelog & announcements',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:beamer',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Beamer',
            'description' => 'Changelog, announcements, and user notifications platform',
            'icon' => 'ph:megaphone',
            'logo' => 'simple-icons:beamer',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.getbeamer.com/docs/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Beamer API key',
                'hint' => 'Find your API key in Beamer Settings → API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getbeamer.com/v0',
                'hint' => 'Override only if using a custom Beamer instance',
                'default' => 'https://api.getbeamer.com/v0',
            ],
        ];
    }

    /**
     * Verify the configured Beamer API key against the user profile endpoint.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.getbeamer.com/v0'), '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Beamer-Api-Key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Beamer API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            $name = trim(($json['firstName'] ?? '') . ' ' . ($json['lastName'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Beamer API as {$name}.",
            ];
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
            'beamer_list_posts' => [
                'class' => BeamerListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List changelog posts and announcements.',
                'icon' => 'ph:list',
            ],
            'beamer_get_post' => [
                'class' => BeamerGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Retrieve a single post by ID.',
                'icon' => 'ph:article',
            ],
            'beamer_create_post' => [
                'class' => BeamerCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new changelog post or announcement.',
                'icon' => 'ph:plus-circle',
            ],
            'beamer_list_comments' => [
                'class' => BeamerListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on a specific post.',
                'icon' => 'ph:chat-circle',
            ],
            'beamer_get_current_user' => [
                'class' => BeamerGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Beamer user profile.',
                'icon' => 'ph:user-circle',
            ],
            'beamer_list_categories' => [
                'class' => BeamerListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List all post categories.',
                'icon' => 'ph:folder',
            ],
            'beamer_api_get' => [
                'class' => BeamerApiGet::class,
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any Beamer GET API endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'beamer_api_post' => [
                'class' => BeamerApiPost::class,
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any Beamer POST API endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'beamer_api_put' => [
                'class' => BeamerApiPut::class,
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any Beamer PUT API endpoint.',
                'icon' => 'ph:terminal-window',
            ],
            'beamer_api_delete' => [
                'class' => BeamerApiDelete::class,
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any Beamer DELETE API endpoint.',
                'icon' => 'ph:terminal-window',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/beamer.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Beamer API URL', 'required' => false, 'default' => 'https://api.getbeamer.com/v0'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Beamer tool with default or account-scoped credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new BeamerService(
                apiKey: $creds->get('beamer', 'api_key', '', $account),
                baseUrl: $creds->get('beamer', 'url', 'https://api.getbeamer.com/v0', $account),
            );

            return new $class($service);
        }

        return new $class(app(BeamerService::class));
    }
}
