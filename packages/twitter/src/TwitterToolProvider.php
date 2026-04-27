<?php

namespace OpenCompany\Integrations\Twitter;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetCurrentUser;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetTweet;
use OpenCompany\Integrations\Twitter\Tools\TwitterGetUser;
use OpenCompany\Integrations\Twitter\Tools\TwitterListTweets;
use OpenCompany\Integrations\Twitter\Tools\TwitterListUsers;
use OpenCompany\Integrations\Twitter\Tools\TwitterSearchTweets;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TwitterToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'twitter';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tweets, search, users',
            'description' => 'Social media platform',
            'icon' => 'ri:twitter-x-fill',
            'logo' => 'simple-icons:x',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Access tweets, search, and user data via the Twitter API v2.',
            'icon' => 'ri:twitter-x-fill',
            'logo' => 'simple-icons:x',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://developer.twitter.com/en/docs/twitter-api',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token (Bearer)',
                'placeholder' => 'Enter your Twitter API Bearer token',
                'hint' => 'Generate a Bearer token in the <a href="https://developer.twitter.com/en/portal/dashboard" target="_blank">Twitter Developer Portal</a> under your app\'s "Keys and tokens" section.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.twitter.com/2',
                'hint' => 'Use <code>https://api.twitter.com/2</code> for the standard API. Change only if using a proxy or custom endpoint.',
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
            ])->timeout(10)->get($baseUrl . '/2/users/me');

            $json = $response->json();

            if ($response->successful() && isset($json['data'])) {
                $username = $json['data']['username'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Twitter API as @{$username}.",
                ];
            }

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Twitter API at {$baseUrl}. Check the URL.",
                ];
            }

            $error = $json['title'] ?? $json['detail'] ?? 'Unknown error';

            return [
                'success' => false,
                'error' => "Twitter API error: {$error}",
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
            'twitter_list_tweets' => [
                'class' => TwitterListTweets::class,
                'type' => 'read',
                'name' => 'List Tweets',
                'description' => 'List recent tweets with pagination.',
                'icon' => 'ri:twitter-x-fill',
            ],
            'twitter_get_tweet' => [
                'class' => TwitterGetTweet::class,
                'type' => 'read',
                'name' => 'Get Tweet',
                'description' => 'Get a single tweet by ID.',
                'icon' => 'ri:twitter-x-fill',
            ],
            'twitter_list_users' => [
                'class' => TwitterListUsers::class,
                'type' => 'read',
                'name' => 'List Users (Followers)',
                'description' => 'List followers of a user with pagination.',
                'icon' => 'ph:users',
            ],
            'twitter_get_user' => [
                'class' => TwitterGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a user\'s profile by ID.',
                'icon' => 'ph:user',
            ],
            'twitter_search_tweets' => [
                'class' => TwitterSearchTweets::class,
                'type' => 'read',
                'name' => 'Search Tweets',
                'description' => 'Search recent tweets matching a query.',
                'icon' => 'ph:magnifying-glass',
            ],
            'twitter_get_current_user' => [
                'class' => TwitterGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/twitter.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token (Bearer)', 'required' => true],
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
