<?php

namespace OpenCompany\Integrations\Bluesky;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyCreatePost;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetCurrentUser;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetProfile;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyListFollowers;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyListFollowing;
use OpenCompany\Integrations\Bluesky\Tools\BlueskySearchPosts;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class BlueskyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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




/**
     * Machine name used as the integration key.
     */
    public function appName(): string
    {
        return 'bluesky';
    }

/**
     * Short metadata shown in UI tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Bluesky',
            'description' => 'Social networking',
            'icon' => 'ph:blue butterfly',
            'logo' => 'simple-icons:bluesky',
        ];
    }

/**
     * Full integration metadata for the integrations catalogue.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Bluesky',
            'description' => 'Decentralised social network powered by the AT Protocol',
            'icon' => 'ph:blue butterfly',
            'logo' => 'simple-icons:bluesky',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bsky.app/docs/api',
        ];
    }/**
     * Configuration schema for the Bluesky integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Bluesky access token',
                'hint' => 'Generate an app password in your Bluesky account settings and use the AT Protocol <code>createSession</code> endpoint, or use an OAuth token',
                'required' => true,
            ],
            [
                'key' => 'did',
                'type' => 'string',
                'label' => 'DID',
                'placeholder' => 'did:plc:...',
                'hint' => 'Your Decentralised Identifier (DID). Required for posting. Find it in your Bluesky profile settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'PDS URL',
                'placeholder' => 'https://bsky.social',
                'hint' => 'Use <code>https://bsky.social</code> for the default instance, or your self-hosted PDS URL',
                'default' => 'https://bsky.social',
            ],
        ];
    }

    /**
     * Test the Bluesky connection by fetching the authenticated user's profile.
     *
     * @param  array  $config  Configuration values supplied by the user.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://bsky.social', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/xrpc/app.bsky.actor.getProfile', [
                'actor' => $config['did'] ?? 'self',
            ]);

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Bluesky API at {$baseUrl}. Check the URL.",
                ];
            }

            $handle = $json['handle'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Bluesky as @{$handle}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration values.
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'did' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Return all tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'bluesky_create_post' => [
                'class' => BlueskyCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Create a new post on Bluesky.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'bluesky_get_profile' => [
                'class' => BlueskyGetProfile::class,
                'type' => 'read',
                'name' => 'Get Profile',
                'description' => 'Get the profile of a Bluesky user.',
                'icon' => 'ph:user-circle',
            ],
            'bluesky_list_followers' => [
                'class' => BlueskyListFollowers::class,
                'type' => 'read',
                'name' => 'List Followers',
                'description' => 'List followers of a Bluesky account.',
                'icon' => 'ph:users',
            ],
            'bluesky_list_following' => [
                'class' => BlueskyListFollowing::class,
                'type' => 'read',
                'name' => 'List Following',
                'description' => 'List accounts a Bluesky user follows.',
                'icon' => 'ph:user-plus',
            ],
            'bluesky_search_posts' => [
                'class' => BlueskySearchPosts::class,
                'type' => 'read',
                'name' => 'Search Posts',
                'description' => 'Search for posts on Bluesky.',
                'icon' => 'ph:magnifying-glass',
            ],
            'bluesky_get_current_user' => [
                'class' => BlueskyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s own Bluesky profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bluesky.md';
    }

    /**
     * Credential fields used for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'did', 'type' => 'string', 'label' => 'DID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'PDS URL', 'required' => false, 'default' => 'https://bsky.social'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * When a multi-account `$context['account']` is provided the tool receives
     * a fresh {@see BlueskyService} built from that account's credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array  $context  May contain an `account` key for multi-account.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BlueskyService(
                accessToken: $creds->get('bluesky', 'access_token', '', $account),
                baseUrl: $creds->get('bluesky', 'url', 'https://bsky.social', $account),
                did: $creds->get('bluesky', 'did', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BlueskyService::class));
    }
}
