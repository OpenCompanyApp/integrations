<?php

namespace OpenCompany\Integrations\Twitter;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Twitter\Tools\TwitterCreateTweet;
use OpenCompany\Integrations\Twitter\Tools\TwitterDeleteTweet;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetCurrentUser;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetTweet;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetUser;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetUserByUsername;
use OpenCompany\Integrations\Twitter\Tools\TwitterListTweets;
use OpenCompany\Integrations\Twitter\Tools\TwitterSearchTweets;

class TwitterToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'twitter';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tweets, search, users',
            'description' => 'Social media',
            'icon' => 'ri:twitter-x-fill',
            'logo' => 'ri:twitter-x-fill',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Post tweets, search content, and manage profiles on Twitter/X via the v2 API.',
            'icon' => 'ri:twitter-x-fill',
            'logo' => 'ri:twitter-x-fill',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://developer.twitter.com/en/docs/twitter-api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Twitter API Bearer Token',
                'hint' => 'Generate a Bearer Token in the <a href="https://developer.twitter.com/en/portal/dashboard" target="_blank">Twitter Developer Portal</a> under your app\'s "Keys and tokens" section.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.twitter.com/2',
                'hint' => 'The Twitter API v2 base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.twitter.com/2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.twitter.com/2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($response->status() === 401) {
                return [
                    'success' => false,
                    'error' => 'Invalid access token. Verify your Bearer Token in the Twitter Developer Portal.',
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Twitter API at {$baseUrl}. Check the URL and try again.",
                ];
            }

            $username = $json['data']['username'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Twitter API as @{$username}.",
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
            'twitter_get_current_user' => [
                'class' => TwitterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
            'twitter_get_user' => [
                'class' => TwitterGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a Twitter user by numeric ID.',
                'icon' => 'ph:user',
            ],
            'twitter_get_user_by_username' => [
                'class' => TwitterGetUserByUsername::class,
                'type' => 'read',
                'name' => 'Get User by Username',
                'description' => 'Look up a Twitter user by username (handle).',
                'icon' => 'ph:at',
            ],
            'twitter_list_tweets' => [
                'class' => TwitterListTweets::class,
                'type' => 'read',
                'name' => 'List Tweets',
                'description' => 'List recent tweets from a user.',
                'icon' => 'ph:list-bullets',
            ],
            'twitter_get_tweet' => [
                'class' => TwitterGetTweet::class,
                'type' => 'read',
                'name' => 'Get Tweet',
                'description' => 'Get a single tweet by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'twitter_search_tweets' => [
                'class' => TwitterSearchTweets::class,
                'type' => 'read',
                'name' => 'Search Tweets',
                'description' => 'Search recent tweets (last 7 days) using a query.',
                'icon' => 'ph:magnifying-glass',
            ],
            'twitter_create_tweet' => [
                'class' => TwitterCreateTweet::class,
                'type' => 'write',
                'name' => 'Create Tweet',
                'description' => 'Post a new tweet.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'twitter_delete_tweet' => [
                'class' => TwitterDeleteTweet::class,
                'type' => 'write',
                'name' => 'Delete Tweet',
                'description' => 'Delete a tweet by ID.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/twitter.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.twitter.com/2'],
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

            $service = new TwitterService(
                accessToken: $creds->get('twitter', 'access_token', '', $account),
                baseUrl: $creds->get('twitter', 'url', 'https://api.twitter.com/2', $account),
            );

            return new $class($service);
        }

        return new $class(app(TwitterService::class));
    }
}
