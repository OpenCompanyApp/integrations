<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\X\Tools\XCreateTweet;
use OpenCompany\Integrations\X\Tools\XGetCurrentUser;
use OpenCompany\Integrations\X\Tools\XGetTweet;
use OpenCompany\Integrations\X\Tools\XGetUser;
use OpenCompany\Integrations\X\Tools\XGetUserByUsername;
use OpenCompany\Integrations\X\Tools\XListTweets;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class XToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'x';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Twitter / X',
            'description' => 'Social media',
            'icon' => 'ph:twitter-logo',
            'logo' => 'simple-icons:x',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Read and post tweets, look up user profiles via the Twitter API v2',
            'icon' => 'ph:twitter-logo',
            'logo' => 'simple-icons:x',
            'category' => 'social',
            'badge' => 'verified',
            'docs_url' => 'https://developer.x.com/en/docs/twitter-api',
        ];
    }
        public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate that required credentials were supplied for this integration.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']) . ' is required.',
                ];
            }
        }

        return [
            'success' => true,
            'message' => 'Required credentials are configured. API access will be verified when tools run.',
        ];
    }
public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'base_url' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'x_create_tweet' => [
                'class' => XCreateTweet::class,
                'type' => 'write',
                'name' => 'X Create Tweet',
                'description' => 'Post a new tweet. Supports text only, replies, and media attachments. The tweet text must not exceed 280 characters.',
                'icon' => 'ph:wrench',
            ],
            'x_get_current_user' => [
                'class' => XGetCurrentUser::class,
                'type' => 'read',
                'name' => 'X Get Current User',
                'description' => 'Get the authenticated user\'s own profile. Returns your user ID, name, and username, plus any additional requested fields.',
                'icon' => 'ph:wrench',
            ],
            'x_get_tweet' => [
                'class' => XGetTweet::class,
                'type' => 'read',
                'name' => 'X Get Tweet',
                'description' => 'Get a single tweet by ID. Returns the tweet text, author ID, creation date, and public metrics (likes, retweets, replies).',
                'icon' => 'ph:wrench',
            ],
            'x_get_user' => [
                'class' => XGetUser::class,
                'type' => 'read',
                'name' => 'X Get User',
                'description' => 'Get a Twitter user by their numeric ID. Returns the user\'s name, username, and optionally their bio, profile image, and public metrics.',
                'icon' => 'ph:wrench',
            ],
            'x_get_user_by_username' => [
                'class' => XGetUserByUsername::class,
                'type' => 'read',
                'name' => 'X Get User By Username',
                'description' => 'Get a Twitter user by their username (handle). Enter the username without the @ prefix. Returns the user\'s ID, name, username, and any additional requested fields.',
                'icon' => 'ph:wrench',
            ],
            'x_list_tweets' => [
                'class' => XListTweets::class,
                'type' => 'read',
                'name' => 'X List Tweets',
                'description' => 'Look up multiple tweets by their IDs. Pass up to 100 tweet IDs and receive their text, metrics, and metadata in one call.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/x.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.twitter.com/2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param class-string<Tool> $class Fully-qualified tool class name
     * @param array<string, mixed> $context Runtime context (may include 'account' key)
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the XService, with optional account-specific credentials.
     *
     * When `$context['account']` is set, creates a fresh service with that
     * account's credentials. Otherwise falls back to the container singleton.
     *
     * @param array<string, mixed> $context Runtime context
     */
    private function resolveService(array $context = []): XService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new XService(
                accessToken: $creds->get('x', 'access_token', '', $account),
                baseUrl: $creds->get('x', 'base_url', 'https://api.twitter.com/2', $account),
            );
        }

        return app(XService::class);
    }
}
