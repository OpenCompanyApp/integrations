<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Reddit\Tools\RedditListPosts;
use OpenCompany\Integrations\Reddit\Tools\RedditGetPost;
use OpenCompany\Integrations\Reddit\Tools\RedditCreatePost;
use OpenCompany\Integrations\Reddit\Tools\RedditListSubreddits;
use OpenCompany\Integrations\Reddit\Tools\RedditGetSubreddit;
use OpenCompany\Integrations\Reddit\Tools\RedditListComments;
use OpenCompany\Integrations\Reddit\Tools\RedditGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RedditToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'reddit';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'posts, subreddits, comments',
            'description' => 'Social news and discussion platform',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:reddit',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Reddit',
            'description' => 'Browse and manage Reddit posts, subreddits, and comments',
            'icon' => 'ph:chat-circle-dots',
            'logo' => 'simple-icons:reddit',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.reddit.com/dev/api/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Reddit OAuth access token',
                'hint' => 'Obtain an OAuth access token via the Reddit authorization flow. See <a href="https://www.reddit.com/dev/api/" target="_blank">Reddit API docs</a> for details.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://oauth.reddit.com/v1',
                'hint' => 'Use <code>https://oauth.reddit.com/v1</code> for the default OAuth API, or a custom endpoint',
                'default' => 'https://oauth.reddit.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://oauth.reddit.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'User-Agent' => 'OpenCompany-Integrations/1.0',
            ])->timeout(10)->get($baseUrl . '/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Reddit API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Reddit API as u/{$json['name']}.",
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
            'reddit_list_posts' => [
                'class' => RedditListPosts::class,
                'type' => 'read',
                'name' => 'List Posts',
                'description' => 'List posts from a subreddit or the front page.',
                'icon' => 'ph:list-bullets',
            ],
            'reddit_get_post' => [
                'class' => RedditGetPost::class,
                'type' => 'read',
                'name' => 'Get Post',
                'description' => 'Get details for a specific Reddit post.',
                'icon' => 'ph:article',
            ],
            'reddit_create_post' => [
                'class' => RedditCreatePost::class,
                'type' => 'write',
                'name' => 'Create Post',
                'description' => 'Submit a new post to a subreddit.',
                'icon' => 'ph:plus-circle',
            ],
            'reddit_list_subreddits' => [
                'class' => RedditListSubreddits::class,
                'type' => 'read',
                'name' => 'List Subreddits',
                'description' => 'List popular or new subreddits.',
                'icon' => 'ph:folders',
            ],
            'reddit_get_subreddit' => [
                'class' => RedditGetSubreddit::class,
                'type' => 'read',
                'name' => 'Get Subreddit',
                'description' => 'Get information about a specific subreddit.',
                'icon' => 'ph:folder',
            ],
            'reddit_list_comments' => [
                'class' => RedditListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments for a specific Reddit post.',
                'icon' => 'ph:chat-text',
            ],
            'reddit_get_current_user' => [
                'class' => RedditGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Reddit user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/reddit.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://oauth.reddit.com/v1'],
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

            $service = new RedditService(
                accessToken: $creds->get('reddit', 'access_token', '', $account),
                baseUrl: $creds->get('reddit', 'url', 'https://oauth.reddit.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(RedditService::class));
    }
}
