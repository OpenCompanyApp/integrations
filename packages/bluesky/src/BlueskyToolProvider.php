<?php

namespace OpenCompany\Integrations\Bluesky;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyCreatePost;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyCreateRecord;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyDeleteRecord;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyFollowActor;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetAuthorFeed;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetCurrentUser;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetFeed;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetFeedGenerator;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetLikes;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetPostThread;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetPosts;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetProfile;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetRepostedBy;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyGetTimeline;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyLikePost;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyListFollowers;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyListFollowing;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyListNotifications;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyRepostPost;
use OpenCompany\Integrations\Bluesky\Tools\BlueskySearchPosts;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyXrpcGet;
use OpenCompany\Integrations\Bluesky\Tools\BlueskyXrpcPost;

/**
 * Tool catalog and configuration metadata for Bluesky.
 *
 * Exposes common Bluesky app views, repository writes, and generic XRPC tools
 * for broader AT Protocol coverage.
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
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Hosts may store either a Bluesky OAuth access token or an AT Protocol session access token.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
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
        return 'bluesky';
    }

    /**
     * Short metadata shown in UI tool listings.
     *
     * @return array<string, string>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Bluesky',
            'description' => 'AT Protocol social data',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:bluesky',
        ];
    }

    /**
     * Full integration metadata for the integrations catalog.
     *
     * @return array<string, string>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Bluesky',
            'description' => 'Bluesky and AT Protocol XRPC tools for feeds, actors, records, notifications, and interactions',
            'icon' => 'ph:chat-circle-text',
            'logo' => 'simple-icons:bluesky',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.bsky.app/docs/api',
        ];
    }

    /**
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
                'placeholder' => 'Enter your Bluesky or AT Protocol access token',
                'hint' => 'Use an OAuth access token or an AT Protocol session token.',
                'required' => true,
            ],
            [
                'key' => 'did',
                'type' => 'string',
                'label' => 'DID',
                'placeholder' => 'did:plc:...',
                'hint' => 'Required for repository writes such as posts, likes, reposts, and follows.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'PDS URL',
                'placeholder' => 'https://bsky.social',
                'hint' => 'Use https://bsky.social for the default PDS or a self-hosted PDS URL.',
                'default' => 'https://bsky.social',
            ],
        ];
    }

    /**
     * Test the Bluesky connection by fetching a configured profile.
     *
     * @param  array<string, mixed>  $config  Configuration values supplied by the user.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $did = (string) ($config['did'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://bsky.social'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided.'];
        }

        if ($did === '') {
            return ['success' => false, 'error' => 'No DID provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/xrpc/app.bsky.actor.getProfile', ['actor' => $did]);

            if ($response->successful()) {
                $handle = $response->json('handle') ?? $did;

                return ['success' => true, 'message' => "Connected to Bluesky as {$handle}."];
            }

            $error = $response->json('message') ?? $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Bluesky API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for configuration values.
     *
     * @return array<string, string>
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
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'bluesky_create_post' => ['class' => BlueskyCreatePost::class, 'type' => 'write', 'name' => 'Create Post', 'description' => 'Create a new post on Bluesky.', 'icon' => 'ph:paper-plane-tilt'],
            'bluesky_get_profile' => ['class' => BlueskyGetProfile::class, 'type' => 'read', 'name' => 'Get Profile', 'description' => 'Get the profile of a Bluesky user.', 'icon' => 'ph:user-circle'],
            'bluesky_get_timeline' => ['class' => BlueskyGetTimeline::class, 'type' => 'read', 'name' => 'Get Timeline', 'description' => 'Get the authenticated account timeline.', 'icon' => 'ph:list'],
            'bluesky_get_author_feed' => ['class' => BlueskyGetAuthorFeed::class, 'type' => 'read', 'name' => 'Get Author Feed', 'description' => 'Get posts and reposts by an actor.', 'icon' => 'ph:user-list'],
            'bluesky_get_feed' => ['class' => BlueskyGetFeed::class, 'type' => 'read', 'name' => 'Get Feed', 'description' => 'Get posts from a feed generator.', 'icon' => 'ph:rss'],
            'bluesky_get_feed_generator' => ['class' => BlueskyGetFeedGenerator::class, 'type' => 'read', 'name' => 'Get Feed Generator', 'description' => 'Get feed generator metadata.', 'icon' => 'ph:rss-simple'],
            'bluesky_get_post_thread' => ['class' => BlueskyGetPostThread::class, 'type' => 'read', 'name' => 'Get Post Thread', 'description' => 'Get a post thread by URI.', 'icon' => 'ph:chat-centered-text'],
            'bluesky_get_posts' => ['class' => BlueskyGetPosts::class, 'type' => 'read', 'name' => 'Get Posts', 'description' => 'Get one or more posts by URI.', 'icon' => 'ph:article'],
            'bluesky_get_likes' => ['class' => BlueskyGetLikes::class, 'type' => 'read', 'name' => 'Get Likes', 'description' => 'Get actors who liked a post.', 'icon' => 'ph:heart'],
            'bluesky_get_reposted_by' => ['class' => BlueskyGetRepostedBy::class, 'type' => 'read', 'name' => 'Get Reposted By', 'description' => 'Get actors who reposted a post.', 'icon' => 'ph:repeat'],
            'bluesky_list_followers' => ['class' => BlueskyListFollowers::class, 'type' => 'read', 'name' => 'List Followers', 'description' => 'List followers of a Bluesky account.', 'icon' => 'ph:users'],
            'bluesky_list_following' => ['class' => BlueskyListFollowing::class, 'type' => 'read', 'name' => 'List Following', 'description' => 'List accounts a Bluesky user follows.', 'icon' => 'ph:user-plus'],
            'bluesky_search_posts' => ['class' => BlueskySearchPosts::class, 'type' => 'read', 'name' => 'Search Posts', 'description' => 'Search for posts on Bluesky.', 'icon' => 'ph:magnifying-glass'],
            'bluesky_list_notifications' => ['class' => BlueskyListNotifications::class, 'type' => 'read', 'name' => 'List Notifications', 'description' => 'List notifications for the authenticated account.', 'icon' => 'ph:bell'],
            'bluesky_get_current_user' => ['class' => BlueskyGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated user profile.', 'icon' => 'ph:identification-badge'],
            'bluesky_create_record' => ['class' => BlueskyCreateRecord::class, 'type' => 'write', 'name' => 'Create Record', 'description' => 'Create an arbitrary AT Protocol record.', 'icon' => 'ph:plus-circle'],
            'bluesky_delete_record' => ['class' => BlueskyDeleteRecord::class, 'type' => 'write', 'name' => 'Delete Record', 'description' => 'Delete an AT Protocol record.', 'icon' => 'ph:trash'],
            'bluesky_like_post' => ['class' => BlueskyLikePost::class, 'type' => 'write', 'name' => 'Like Post', 'description' => 'Like a Bluesky post.', 'icon' => 'ph:heart'],
            'bluesky_repost_post' => ['class' => BlueskyRepostPost::class, 'type' => 'write', 'name' => 'Repost Post', 'description' => 'Repost a Bluesky post.', 'icon' => 'ph:repeat'],
            'bluesky_follow_actor' => ['class' => BlueskyFollowActor::class, 'type' => 'write', 'name' => 'Follow Actor', 'description' => 'Follow an actor DID.', 'icon' => 'ph:user-plus'],
            'bluesky_xrpc_get' => ['class' => BlueskyXrpcGet::class, 'type' => 'read', 'name' => 'XRPC GET', 'description' => 'Call any GET XRPC method.', 'icon' => 'ph:terminal-window'],
            'bluesky_xrpc_post' => ['class' => BlueskyXrpcPost::class, 'type' => 'write', 'name' => 'XRPC POST', 'description' => 'Call any POST XRPC method.', 'icon' => 'ph:terminal-window'],
        ];
    }

    /**
     * Path to the JavaScript API reference documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/bluesky.md';
    }

    /**
     * Credential fields used for multi-account support.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally scoped to a specific account.
     *
     * @param  class-string<Tool>  $class  Tool class.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Bluesky service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): BlueskyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BlueskyService(
                accessToken: $creds->get('bluesky', 'access_token', '', $account),
                baseUrl: $creds->get('bluesky', 'url', 'https://bsky.social', $account),
                did: $creds->get('bluesky', 'did', '', $account),
            );
        }

        return app(BlueskyService::class);
    }
}
