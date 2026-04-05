<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Reddit\Tools\RedditListPosts;
use OpenCompany\Integrations\Reddit\Tools\RedditGetPost;
use OpenCompany\Integrations\Reddit\Tools\RedditCreatePost;
use OpenCompany\Integrations\Reddit\Tools\RedditSearch;
use OpenCompany\Integrations\Reddit\Tools\RedditListSubreddits;
use OpenCompany\Integrations\Reddit\Tools\RedditGetSubreddit;
use OpenCompany\Integrations\Reddit\Tools\RedditCreateComment;
use OpenCompany\Integrations\Reddit\Tools\RedditGetCurrentUser;

/**
 * Tool provider for the Reddit integration.
 *
 * Implements ConfigurableIntegration for multi-account credential management
 * and ToolProvider for registration with the AI agent tool registry.
 * Exposes eight tools covering subreddit browsing, post management, search,
 * commenting, and user identity.
 */
class RedditToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the machine name of this integration.
     */
    public function appName(): string
    {
        return 'reddit';
    }

    /**
     * Get metadata for displaying the integration in UI listings.
     *
     * @return array{label: string, description: string, icon: string, logo: string}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'posts, search, subreddits, comments',
            'description' => 'Social news and discussion',
            'icon' => 'simple-icons:reddit',
            'logo' => 'simple-icons:reddit',
        ];
    }

    /**
     * Get detailed integration metadata for the integrations catalog.
     *
     * @return array{name: string, description: string, icon: string, logo: string, category: string, badge: string, docs_url: string}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Reddit',
            'description' => 'Browse subreddits, read and create posts, search content, and post comments on Reddit.',
            'icon' => 'simple-icons:reddit',
            'logo' => 'simple-icons:reddit',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://www.reddit.com/dev/api/',
        ];
    }

    /**
     * Get the configuration schema for setting up Reddit credentials.
     *
     * Defines the fields required to connect to the Reddit OAuth2 API,
     * including the access token, optional custom base URL, and user-agent.
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
                'placeholder' => 'Enter your Reddit OAuth2 access token',
                'hint' => 'Obtain an access token via Reddit\'s OAuth2 flow. See <a href="https://www.reddit.com/dev/api/" target="_blank">Reddit API docs</a> for details.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://oauth.reddit.com',
                'hint' => 'Use <code>https://oauth.reddit.com</code> for the standard Reddit API.',
                'default' => 'https://oauth.reddit.com',
            ],
            [
                'key' => 'user_agent',
                'type' => 'text',
                'label' => 'User-Agent',
                'placeholder' => 'OpenCompany/1.0',
                'hint' => 'A descriptive User-Agent string identifying your application to Reddit.',
                'default' => 'OpenCompany/1.0',
            ],
        ];
    }

    /**
     * Test the Reddit API connection using the provided configuration.
     *
     * Calls the /api/v1/me endpoint to verify the access token is valid.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token', 'url', and optional 'user_agent'.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://oauth.reddit.com', '/');
        $userAgent = $config['user_agent'] ?? 'OpenCompany/1.0';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => $userAgent,
            ])->timeout(10)->get($baseUrl . '/api/v1/me');

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Reddit API returned: {$error}",
                ];
            }

            $json = $response->json();
            $username = $json['name'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Reddit as u/{$username}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
            'user_agent' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * Each entry maps a tool key to its class, type (read/write), display name,
     * description, and icon for UI rendering.
     *
     * @return array<string, array{class: string, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'reddit_list_posts' => [
                'class' => RedditListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List hot posts from a subreddit.',
                'icon' => 'simple-icons:reddit',
            ],
            'reddit_get_post' => [
                'class' => RedditGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get a specific post with its comments.',
                'icon' => 'simple-icons:reddit',
            ],
            'reddit_create_post' => [
                'class' => RedditCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Submit a new post to a subreddit.',
                'icon' => 'ph:pencil-simple',
            ],
            'reddit_search' => [
                'class' => RedditSearch::class,
                'type' => 'read',
                'name' => 'Search',
                'description' => 'Search Reddit for posts and subreddits.',
                'icon' => 'ph:magnifying-glass',
            ],
            'reddit_list_subreddits' => [
                'class' => RedditListSubreddits::class,
                'type' => 'read',
                'name' => 'List Subreddits',
                'description' => 'List popular subreddits.',
                'icon' => 'ph:list',
            ],
            'reddit_get_subreddit' => [
                'class' => RedditGetSubreddit::class,
                'type' => 'read',
                'name' => 'Get Subreddit',
                'description' => 'Get details about a subreddit.',
                'icon' => 'simple-icons:reddit',
            ],
            'reddit_create_comment' => [
                'class' => RedditCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Post a comment on a post or reply to a comment.',
                'icon' => 'ph:chat-circle-text',
            ],
            'reddit_get_current_user' => [
                'class' => RedditGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the filesystem path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/reddit.md';
    }

    /**
     * Get the credential fields for quick-connect setups.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API URL', 'required' => false, 'default' => 'https://oauth.reddit.com'],
            ['key' => 'user_agent', 'type' => 'text', 'label' => 'User-Agent', 'required' => false, 'default' => 'OpenCompany/1.0'],
        ];
    }

    /**
     * Confirm this class represents an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * When an account context is provided, resolves credentials for that specific
     * account. Otherwise, falls back to the default container-bound service.
     *
     * @param  string  $class  Fully-qualified class name of the tool to instantiate.
     * @param  array<string, mixed>  $context  Context array, may contain 'account' key for multi-account support.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new RedditService(
                accessToken: $creds->get('reddit', 'access_token', '', $account),
                baseUrl: $creds->get('reddit', 'url', 'https://oauth.reddit.com', $account),
                userAgent: $creds->get('reddit', 'user_agent', 'OpenCompany/1.0', $account),
            );

            return new $class($service);
        }

        return new $class(app(RedditService::class));
    }
}
