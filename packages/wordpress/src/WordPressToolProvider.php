<?php

namespace OpenCompany\Integrations\WordPress;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\WordPress\Tools\WordPressListPosts;
use OpenCompany\Integrations\WordPress\Tools\WordPressGetPost;
use OpenCompany\Integrations\WordPress\Tools\WordPressCreatePost;
use OpenCompany\Integrations\WordPress\Tools\WordPressUpdatePost;
use OpenCompany\Integrations\WordPress\Tools\WordPressListPages;
use OpenCompany\Integrations\WordPress\Tools\WordPressListUsers;
use OpenCompany\Integrations\WordPress\Tools\WordPressListComments;
use OpenCompany\Integrations\WordPress\Tools\WordPressGetCurrentUser;

/**
 * Tool provider for the WordPress REST API integration.
 *
 * Registers 8 tools for managing posts, pages, users, and comments on a WordPress site.
 * Implements ConfigurableIntegration for multi-account support and configuration schema.
 */
class WordPressToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the integration identifier.
     *
     * @return string The machine name of the integration.
     */
    public function appName(): string
    {
        return 'wordpress';
    }

    /**
     * Get metadata for displaying the integration in the UI.
     *
     * @return array{label: string, description: string, icon: string, logo: string} UI metadata.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'posts, pages, users, comments',
            'description' => 'Content management',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:wordpress',
        ];
    }

    /**
     * Get integration metadata for the marketplace / integrations page.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string} Integration metadata.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'WordPress',
            'description' => 'Content management via the WordPress REST API',
            'icon' => 'ph:file-text',
            'logo' => 'simple-icons:wordpress',
            'category' => 'cms',
            'badge' => 'verified',
            'docs_url' => 'https://developer.wordpress.org/rest-api/',
        ];
    }

    /**
     * Define the configuration schema for the integration settings UI.
     *
     * @return array<int, array{key: string, type: string, label: string, placeholder?: string, hint?: string, required?: bool, default?: mixed}> Config field definitions.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'WordPress Site URL',
                'placeholder' => 'https://yourdomain.com/wp-json',
                'hint' => 'The base URL of your WordPress REST API. Typically <code>https://yourdomain.com/wp-json</code>',
                'required' => true,
                'default' => 'https://yourdomain.com/wp-json',
            ],
            [
                'key' => 'username',
                'type' => 'text',
                'label' => 'Username',
                'placeholder' => 'admin',
                'hint' => 'Your WordPress username (used for HTTP Basic Auth with an application password).',
                'required' => true,
            ],
            [
                'key' => 'application_password',
                'type' => 'secret',
                'label' => 'Application Password',
                'placeholder' => 'xxxx xxxx xxxx xxxx xxxx xxxx',
                'hint' => 'Generate at <strong>WordPress Admin → Users → Profile → Application Passwords</strong>. Do NOT use your login password.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the WordPress REST API using the provided config.
     *
     * @param array $config Configuration values (url, username, application_password).
     * @return array{success: bool, message?: string, error?: string} Test result.
     */
    public function testConnection(array $config): array
    {
        $url = rtrim($config['url'] ?? 'https://yourdomain.com/wp-json', '/');
        $username = $config['username'] ?? '';
        $password = $config['application_password'] ?? '';

        if (empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Username and application password are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $password)
                ->timeout(10)
                ->get($url . '/wp/v2/users/me');

            if ($response->successful()) {
                $name = $response->json('name') ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to WordPress as {$name}.",
                ];
            }

            if ($response->status() === 401) {
                return ['success' => false, 'error' => 'Authentication failed. Check your username and application password.'];
            }

            if ($response->status() === 404) {
                return ['success' => false, 'error' => "REST API not found at {$url}. Make sure pretty permalinks are enabled."];
            }

            return [
                'success' => false,
                'error' => 'WordPress API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     *
     * @return array<string, string> Laravel validation rules.
     */
    public function validationRules(): array
    {
        return [
            'url' => 'required|url',
            'username' => 'required|string',
            'application_password' => 'required|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}> Tool definitions keyed by tool name.
     */
    public function tools(): array
    {
        return [
            'wordpress_list_posts' => [
                'class' => WordPressListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts from the WordPress site.',
                'icon' => 'ph:article',
            ],
            'wordpress_get_post' => [
                'class' => WordPressGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a single post by ID.',
                'icon' => 'ph:file-text',
            ],
            'wordpress_create_post' => [
                'class' => WordPressCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new post on the WordPress site.',
                'icon' => 'ph:plus-circle',
            ],
            'wordpress_update_post' => [
                'class' => WordPressUpdatePost::class,
                'type' => 'write',
                'name' => 'Update Post',
                'description' => 'Update an existing post.',
                'icon' => 'ph:pencil-simple',
            ],
            'wordpress_list_pages' => [
                'class' => WordPressListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List pages from the WordPress site.',
                'icon' => 'ph:files',
            ],
            'wordpress_list_users' => [
                'class' => WordPressListUsers::class,
                'type' => 'read',
                'name' => 'List Users',
                'description' => 'List users registered on the WordPress site.',
                'icon' => 'ph:users',
            ],
            'wordpress_list_comments' => [
                'class' => WordPressListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments from the WordPress site.',
                'icon' => 'ph:chat-circle',
            ],
            'wordpress_get_current_user' => [
                'class' => WordPressGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated WordPress user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file for this integration.
     *
     * @return string|null Absolute path to the Lua docs markdown file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/wordpress.md';
    }

    /**
     * Get the credential field definitions used for authentication.
     *
     * @return array<int, array{key: string, type: string, label: string, required?: bool}> Credential field definitions.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'url', 'type' => 'url', 'label' => 'WordPress REST API URL', 'required' => true],
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'required' => true],
            ['key' => 'application_password', 'type' => 'secret', 'label' => 'Application Password', 'required' => true],
        ];
    }

    /**
     * Indicate that this class represents an integration (not a standalone tool).
     *
     * @return bool Always true.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific credentials.
     *
     * Supports multi-account setups by resolving per-account credentials from the
     * CredentialResolver when an account key is provided in the context.
     *
     * @param string               $class   Fully-qualified Tool class name.
     * @param array<string, mixed> $context Optional context with 'account' key for multi-account resolution.
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the WordPressService, with optional account-specific credentials.
     *
     * @param array<string, mixed> $context Optional context with 'account' key for multi-account resolution.
     * @return WordPressService The resolved service instance.
     */
    private function resolveService(array $context = []): WordPressService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new WordPressService(
                username: $creds->get('wordpress', 'username', '', $account),
                applicationPassword: $creds->get('wordpress', 'application_password', '', $account),
                baseUrl: $creds->get('wordpress', 'url', 'https://yourdomain.com/wp-json', $account),
            );
        }

        return app(WordPressService::class);
    }
}
