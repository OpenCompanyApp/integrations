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

/**
 * Tool provider for the Twitter/X integration.
 *
 * Declares six tools covering tweet retrieval, creation, and user lookups.
 * Implements {@see ConfigurableIntegration} for the OpenCompany settings UI
 * and supports multi-account credential resolution via {@see createTool()}.
 */
class XToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'x';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'tweets, users, post',
            'description' => 'Social media',
            'icon' => 'ph:twitter-logo',
            'logo' => 'simple-icons:x',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

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
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Bearer Token',
                'placeholder' => 'AAAAAAAAAAAAAAAAAAAAAMyKey...',
                'hint' => 'Generate a Bearer Token in the <a href="https://developer.x.com/en/portal/dashboard" target="_blank">Twitter Developer Portal</a> under your app\'s "Keys and tokens" section.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.twitter.com/2',
                'hint' => 'Defaults to <code>https://api.twitter.com/2</code>. Override for proxies or enterprise access.',
                'default' => 'https://api.twitter.com/2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['base_url'] ?? 'https://api.twitter.com/2', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No Bearer token provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($response->successful() && isset($json['data'])) {
                $username = $json['data']['username'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Twitter API as @{$username}.",
                ];
            }

            $error = $json['title'] ?? $json['detail'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Twitter API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'x_get_tweet' => [
                'class' => XGetTweet::class,
                'type' => 'read',
                'name' => 'Get Tweet',
                'description' => 'Get a single tweet by ID.',
                'icon' => 'ph:chat-circle-text',
            ],
            'x_list_tweets' => [
                'class' => XListTweets::class,
                'type' => 'read',
                'name' => 'List Tweets',
                'description' => 'Look up multiple tweets by their IDs.',
                'icon' => 'ph:list',
            ],
            'x_create_tweet' => [
                'class' => XCreateTweet::class,
                'type' => 'write',
                'name' => 'Create Tweet',
                'description' => 'Post a new tweet.',
                'icon' => 'ph:plus-circle',
            ],
            'x_get_user' => [
                'class' => XGetUser::class,
                'type' => 'read',
                'name' => 'Get User',
                'description' => 'Get a user by their numeric ID.',
                'icon' => 'ph:user',
            ],
            'x_get_user_by_username' => [
                'class' => XGetUserByUsername::class,
                'type' => 'read',
                'name' => 'Get User by Username',
                'description' => 'Get a user by their username (handle).',
                'icon' => 'ph:at',
            ],
            'x_get_current_user' => [
                'class' => XGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user\'s profile.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/twitter.md';
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
    {
        return new $class($this->resolveService($context));
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
