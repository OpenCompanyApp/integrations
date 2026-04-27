<?php

namespace OpenCompany\Integrations\Discourse;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Discourse\Tools\DiscourseListTopics;
use OpenCompany\Integrations\Discourse\Tools\DiscourseGetTopic;
use OpenCompany\Integrations\Discourse\Tools\DiscourseCreateTopic;
use OpenCompany\Integrations\Discourse\Tools\DiscourseUpdateTopic;
use OpenCompany\Integrations\Discourse\Tools\DiscourseListCategories;
use OpenCompany\Integrations\Discourse\Tools\DiscourseGetCategory;
use OpenCompany\Integrations\Discourse\Tools\DiscourseCreatePost;
use OpenCompany\Integrations\Discourse\Tools\DiscourseGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class DiscourseToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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




/**
     * Get the short application name used as the integration key.
     */
    public function appName(): string
    {
        return 'discourse';
    }

/**
     * Get metadata for the app display (tool listing).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'topics, posts, categories',
            'description' => 'Forum & community',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:discourse',
        ];
    }

/**
     * Get integration metadata for the Integrations UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Discourse',
            'description' => 'Forum and community platform integration',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:discourse',
            'category' => 'communication',
            'badge' => 'verified',
            'docs_url' => 'https://docs.discourse.org/',
        ];
    }/**
     * Get the configuration schema for the Integrations UI.
     *
     * Defines the fields needed to connect to a Discourse instance:
     * API key, API username, and hostname.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Discourse API key',
                'hint' => 'Generate an API key in your Discourse admin panel under "API" → "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'api_username',
                'type' => 'string',
                'label' => 'API Username',
                'placeholder' => 'system',
                'hint' => 'The username associated with the API key. Use <code>system</code> for all-user keys.',
                'required' => true,
            ],
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Hostname',
                'placeholder' => 'discuss.example.com',
                'hint' => 'Your Discourse instance hostname (e.g., <code>discuss.example.com</code>). Do not include <code>https://</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Discourse instance.
     *
     * Sends a GET request to /site.json to verify that the API credentials
     * and hostname are valid.
     *
     * @param array $config The integration configuration (api_key, api_username, hostname).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $apiUsername = $config['api_username'] ?? '';
        $hostname = rtrim($config['hostname'] ?? '', '/');

        if (empty($apiKey) || empty($apiUsername) || empty($hostname)) {
            return ['success' => false, 'error' => 'API key, username, and hostname are all required.'];
        }

        try {
            $url = 'https://' . $hostname . '/site.json';

            $response = Http::withHeaders([
                'Api-Key' => $apiKey,
                'Api-Username' => $apiUsername,
            ])->timeout(10)->get($url);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Discourse API at {$hostname}. Check the hostname and try again.",
                ];
            }

            $siteTitle = $json['title'] ?? $hostname;

            return [
                'success' => true,
                'message' => "Connected to Discourse ({$siteTitle}) at {$hostname}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'api_username' => 'nullable|string',
            'hostname' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'discourse_list_topics' => [
                'class' => DiscourseListTopics::class,
                'type' => 'read',
                'name' => 'List Topics',
                'description' => 'List latest topics from the forum.',
                'icon' => 'ph:list',
            ],
            'discourse_get_topic' => [
                'class' => DiscourseGetTopic::class,
                'type' => 'read',
                'name' => 'Get Topic',
                'description' => 'Get a single topic with its posts.',
                'icon' => 'ph:chat',
            ],
            'discourse_create_topic' => [
                'class' => DiscourseCreateTopic::class,
                'type' => 'write',
                'name' => 'Create Topic',
                'description' => 'Create a new topic in a category.',
                'icon' => 'ph:plus',
            ],
            'discourse_update_topic' => [
                'class' => DiscourseUpdateTopic::class,
                'type' => 'write',
                'name' => 'Update Topic',
                'description' => 'Update a topic\'s title or category.',
                'icon' => 'ph:pencil',
            ],
            'discourse_list_categories' => [
                'class' => DiscourseListCategories::class,
                'type' => 'read',
                'name' => 'List Categories',
                'description' => 'List all forum categories.',
                'icon' => 'ph:folders',
            ],
            'discourse_get_category' => [
                'class' => DiscourseGetCategory::class,
                'type' => 'read',
                'name' => 'Get Category',
                'description' => 'Get a category with its topic list.',
                'icon' => 'ph:folder-open',
            ],
            'discourse_create_post' => [
                'class' => DiscourseCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Reply to an existing topic.',
                'icon' => 'ph:chat-circle-text',
            ],
            'discourse_get_current_user' => [
                'class' => DiscourseGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/discourse.md';
    }

    /**
     * Get the credential fields for this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_username', 'type' => 'string', 'label' => 'API Username', 'required' => true],
            ['key' => 'hostname', 'type' => 'string', 'label' => 'Hostname', 'required' => true],
        ];
    }

    /**
     * Confirm this class acts as an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance with optional multi-account support.
     *
     * If an account context is provided, resolves credentials for that account.
     * Otherwise, falls back to the default singleton DiscourseService.
     *
     * @param class-string<Tool> $class   The tool class to instantiate.
     * @param array              $context Optional context with 'account' key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new DiscourseService(
                apiKey: $creds->get('discourse', 'api_key', '', $account),
                apiUsername: $creds->get('discourse', 'api_username', '', $account),
                hostname: $creds->get('discourse', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(DiscourseService::class));
    }
}
