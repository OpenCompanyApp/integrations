<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivCreatePost;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivCreateSubscriber;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivDeletePost;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivGetCurrentUser;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivGetPost;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivGetStats;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivGetSubscriber;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivListPosts;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivListSubscribers;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivUpdatePost;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class BeehiivToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'beehiiv';
    }

/**
     * Get metadata for display in the application UI.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'posts, subscribers, stats',
            'description' => 'Newsletter platform',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:beehiiv',
        ];
    }

/**
     * Get integration metadata for the marketplace / integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Beehiiv',
            'description' => 'Newsletter platform — manage posts, subscribers, and analytics.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:beehiiv',
            'category' => 'newsletter',
            'badge' => 'verified',
            'docs_url' => 'https://developers.beehiiv.com/docs',
        ];
    }/**
     * Get the configuration schema for this integration.
     *
     * Defines the fields required: API key and publication ID.
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Beehiiv API key',
                'hint' => 'Generate an API key in your Beehiiv account settings under "Integrations"',
                'required' => true,
            ],
            [
                'key' => 'publication_id',
                'type' => 'string',
                'label' => 'Publication ID',
                'placeholder' => 'pub_xxxxxxxx',
                'hint' => 'Find your publication ID in Beehiiv under Settings → General',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Beehiiv API using the provided config.
     *
     * @param  array<string, mixed>  $config  The configuration to test.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = 'https://api.beehiiv.com/v2';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/publications');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Beehiiv API. Check your API key.',
                ];
            }

            return [
                'success' => true,
                'message' => 'Connected to Beehiiv API successfully.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'publication_id' => 'nullable|string',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'beehiiv_list_posts' => [
                'class' => BeehiivListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts from your Beehiiv publication.',
                'icon' => 'ph:list',
            ],
            'beehiiv_get_post' => [
                'class' => BeehiivGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a single post by ID.',
                'icon' => 'ph:file-text',
            ],
            'beehiiv_create_post' => [
                'class' => BeehiivCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new post in your Beehiiv publication.',
                'icon' => 'ph:plus',
            ],
            'beehiiv_update_post' => [
                'class' => BeehiivUpdatePost::class,
                'type' => 'write',
                'name' => 'Update Post',
                'description' => 'Update an existing post.',
                'icon' => 'ph:pencil',
            ],
            'beehiiv_delete_post' => [
                'class' => BeehiivDeletePost::class,
                'type' => 'write',
                'name' => 'Delete Post',
                'description' => 'Delete a post from your publication.',
                'icon' => 'ph:trash',
            ],
            'beehiiv_list_subscribers' => [
                'class' => BeehiivListSubscribers::class,
                'type' => 'read',
                'name' => 'List Subscribers',
                'description' => 'List subscribers for your Beehiiv publication.',
                'icon' => 'ph:users',
            ],
            'beehiiv_get_subscriber' => [
                'class' => BeehiivGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get a single subscriber by ID.',
                'icon' => 'ph:user',
            ],
            'beehiiv_create_subscriber' => [
                'class' => BeehiivCreateSubscriber::class,
                'type' => 'write',
                'name' => 'Create Subscriber',
                'description' => 'Add a new subscriber to your publication.',
                'icon' => 'ph:user-plus',
            ],
            'beehiiv_get_stats' => [
                'class' => BeehiivGetStats::class,
                'type' => 'read',
                'name' => 'Get Stats',
                'description' => 'Get publication analytics and stats.',
                'icon' => 'ph:chart-bar',
            ],
            'beehiiv_get_current_user' => [
                'class' => BeehiivGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Publications',
                'description' => 'Verify authentication and list accessible publications.',
                'icon' => 'ph:key',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/beehiiv.md';
    }

    /**
     * Get the credential fields for this integration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'publication_id', 'type' => 'string', 'label' => 'Publication ID', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * Supports multi-account by resolving credentials for a specific account
     * when provided via the context.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BeehiivService(
                apiKey: $creds->get('beehiiv', 'api_key', '', $account),
                publicationId: $creds->get('beehiiv', 'publication_id', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BeehiivService::class));
    }
}
