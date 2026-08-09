<?php

namespace OpenCompany\Integrations\X;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides the canonical generated Twitter / X API integration.
 *
 * Tool metadata is generated from the official X OpenAPI document
 * (2.162) and intentionally covers every request operation in it.
 */
class XToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'x';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Twitter / X',
            'description' => 'Organic X API tools',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Twitter / X',
            'description' => 'Full generated coverage of the official X API for posts, users, DMs, lists, media, streams, webhooks, compliance, trends, spaces, and usage.',
            'icon' => 'simple-icons:x',
            'logo' => 'simple-icons:x',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.x.com/x-api',
        ];
    }

    /**
     * Describe X auth and host capability metadata.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'multi_auth',
                'strategies' => ['bearer_token', 'oauth2_pkce', 'oauth1a_user_context'],
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token', 'web_redirect', 'local_redirect', 'pin_oauth1'],
                'requires_browser_for_setup' => true,
                'refreshable' => true,
                'token_keys' => ['bearer_token', 'access_token', 'access_token_secret'],
                'source' => [
                    'type' => 'openapi',
                    'url' => 'https://api.x.com/2/openapi.json',
                    'version' => '2.162',
                    'operation_count' => 162,
                ],
                'notes' => [
                    'Bearer tokens support app-only public read endpoints.',
                    'OAuth 2.0 PKCE user tokens support user-context reads and writes.',
                    'OAuth 1.0a user tokens are supported for endpoints that require UserToken security.',
                    'CLI setup is headless for stored/manual tokens and PIN-based OAuth 1.0a; OAuth 2.0 PKCE setup needs browser or local callback support.',
                ],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_oauth_redirect',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token_or_pin_oauth1',
                    'runtime_mode' => 'normal_except_streaming',
                ],
                'mcp_gateway' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'kosmokrator_gateway',
                    'runtime_mode' => 'request_response_tools',
                ],
            ],
            'runtime_requirements' => [
                [
                    'type' => 'host_capability',
                    'name' => 'streaming_runner',
                    'description' => 'Required for tools marked runtime_mode=stream.',
                ],
                [
                    'type' => 'host_capability',
                    'name' => 'public_webhook_endpoint',
                    'description' => 'Required for webhook and account-activity subscription operations.',
                ],
            ],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
                'mcp_gateway_supported' => true,
                'javascript_supported' => true,
            ],
            'seo' => [
                'aliases' => ['twitter', 'twitter api', 'x api', 'tweets', 'posts'],
            ],
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate X credentials with a lightweight user-context call when possible.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $service = new XService(
            bearerToken: (string) ($config['bearer_token'] ?? ''),
            accessToken: (string) ($config['access_token'] ?? ''),
            apiKey: (string) ($config['api_key'] ?? ''),
            apiSecret: (string) ($config['api_secret'] ?? ''),
            accessTokenSecret: (string) ($config['access_token_secret'] ?? ''),
            baseUrl: (string) ($config['base_url'] ?? 'https://api.x.com/2'),
        );

        return $service->testConnection();
    }

    public function validationRules(): array
    {
        return [
            'bearer_token' => 'nullable|string',
            'access_token' => 'nullable|string',
            'api_key' => 'nullable|string',
            'api_secret' => 'nullable|string',
            'access_token_secret' => 'nullable|string',
            'base_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'x_get_account_activity_subscription_count' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetAccountActivitySubscriptionCount',
                'type' => 'read',
                'name' => 'Get Account Activity Subscription Count',
                'description' => 'Get subscription count',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'getAccountActivitySubscriptionCount',
                'operation' => [
                    'id' => 'getAccountActivitySubscriptionCount',
                    'method' => 'GET',
                    'path' => '/2/account_activity/subscriptions/count',
                    'parameters' => [
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Account Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_validate_account_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XValidateAccountActivitySubscription',
                'type' => 'read',
                'name' => 'Validate Account Activity Subscription',
                'description' => 'Validate subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to check subscription against.',
                    ],
                ],
                'operation_id' => 'validateAccountActivitySubscription',
                'operation' => [
                    'id' => 'validateAccountActivitySubscription',
                    'method' => 'GET',
                    'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/all',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Account Activity',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_account_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateAccountActivitySubscription',
                'type' => 'write',
                'name' => 'Create Account Activity Subscription',
                'description' => 'Create subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to check subscription against.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                    ],
                ],
                'operation_id' => 'createAccountActivitySubscription',
                'operation' => [
                    'id' => 'createAccountActivitySubscription',
                    'method' => 'POST',
                    'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/all',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Account Activity',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_account_activity_subscriptions' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetAccountActivitySubscriptions',
                'type' => 'read',
                'name' => 'Get Account Activity Subscriptions',
                'description' => 'Get subscriptions',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to pull subscriptions for.',
                    ],
                ],
                'operation_id' => 'getAccountActivitySubscriptions',
                'operation' => [
                    'id' => 'getAccountActivitySubscriptions',
                    'method' => 'GET',
                    'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/all/list',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Account Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_account_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteAccountActivitySubscription',
                'type' => 'write',
                'name' => 'Delete Account Activity Subscription',
                'description' => 'Delete subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to check subscription against.',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'User ID to unsubscribe from.',
                    ],
                ],
                'operation_id' => 'deleteAccountActivitySubscription',
                'operation' => [
                    'id' => 'deleteAccountActivitySubscription',
                    'method' => 'DELETE',
                    'path' => '/2/account_activity/webhooks/{webhook_id}/subscriptions/{user_id}/all',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Account Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_activity_stream' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XActivityStream',
                'type' => 'read',
                'name' => 'Activity Stream',
                'description' => 'Activity Stream',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Post labels will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp from which the Post labels will be provided.',
                    ],
                ],
                'operation_id' => 'activityStream',
                'operation' => [
                    'id' => 'activityStream',
                    'method' => 'GET',
                    'path' => '/2/activity/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Activity',
                        'Stream',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_activity_subscriptions_by_ids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteActivitySubscriptionsByIds',
                'type' => 'write',
                'name' => 'Delete Activity Subscriptions By Ids',
                'description' => 'Delete X activity subscriptions by IDs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'Comma-separated list of subscription IDs to delete.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'deleteActivitySubscriptionsByIds',
                'operation' => [
                    'id' => 'deleteActivitySubscriptionsByIds',
                    'method' => 'DELETE',
                    'path' => '/2/activity/subscriptions',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_activity_subscriptions' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetActivitySubscriptions',
                'type' => 'read',
                'name' => 'Get Activity Subscriptions',
                'description' => 'Get X activity subscriptions',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results to return per page.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                ],
                'operation_id' => 'getActivitySubscriptions',
                'operation' => [
                    'id' => 'getActivitySubscriptions',
                    'method' => 'GET',
                    'path' => '/2/activity/subscriptions',
                    'parameters' => [
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateActivitySubscription',
                'type' => 'write',
                'name' => 'Create Activity Subscription',
                'description' => 'Create X activity subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'event_type' => [
                                'type' => 'string',
                                'description' => '',
                                'enum' => [
                                    'profile.update.bio',
                                    'profile.update.profile_picture',
                                    'profile.update.banner_picture',
                                    'profile.update.screenname',
                                    'profile.update.geo',
                                    'profile.update.url',
                                    'profile.update.verified_badge',
                                    'profile.update.affiliate_badge',
                                    'profile.update.handle',
                                    'news.new',
                                    'follow.follow',
                                    'follow.unfollow',
                                    'spaces.start',
                                    'spaces.end',
                                    'chat.received',
                                    'chat.sent',
                                    'chat.conversation_join',
                                    'dm.sent',
                                    'dm.received',
                                    'dm.indicate_typing',
                                    'dm.read',
                                ],
                                'required' => true,
                            ],
                            'filter' => [
                                'type' => 'object',
                                'description' => 'An XAA subscription filter.',
                                'properties' => [
                                    'direction' => [
                                        'type' => 'string',
                                        'description' => 'Optional direction filter for directional events.',
                                        'enum' => [
                                            'inbound',
                                            'outbound',
                                        ],
                                        'required' => false,
                                    ],
                                    'keyword' => [
                                        'type' => 'string',
                                        'description' => 'A keyword to filter on.',
                                        'required' => false,
                                    ],
                                    'user_id' => [
                                        'type' => 'string',
                                        'description' => 'Unique identifier of this User. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => true,
                            ],
                            'tag' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => false,
                            ],
                            'webhook_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this webhook config.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createActivitySubscription',
                'operation' => [
                    'id' => 'createActivitySubscription',
                    'method' => 'POST',
                    'path' => '/2/activity/subscriptions',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Activity',
                        'Stream',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteActivitySubscription',
                'type' => 'write',
                'name' => 'Delete Activity Subscription',
                'description' => 'Deletes X activity subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the subscription to delete.',
                    ],
                ],
                'operation_id' => 'deleteActivitySubscription',
                'operation' => [
                    'id' => 'deleteActivitySubscription',
                    'method' => 'DELETE',
                    'path' => '/2/activity/subscriptions/{subscription_id}',
                    'parameters' => [
                        [
                            'name' => 'subscription_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_update_activity_subscription' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUpdateActivitySubscription',
                'type' => 'write',
                'name' => 'Update Activity Subscription',
                'description' => 'Update X activity subscription',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'subscription_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the subscription to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'tag' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => false,
                            ],
                            'webhook_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this webhook config.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'updateActivitySubscription',
                'operation' => [
                    'id' => 'updateActivitySubscription',
                    'method' => 'PUT',
                    'path' => '/2/activity/subscriptions/{subscription_id}',
                    'parameters' => [
                        [
                            'name' => 'subscription_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Activity',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_chat_conversations' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetChatConversations',
                'type' => 'read',
                'name' => 'Get Chat Conversations',
                'description' => 'Get Chat Conversations',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Maximum number of conversations to return.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token for pagination to retrieve the next page of results.',
                    ],
                    'chat_conversation.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of ChatConversation fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getChatConversations',
                'operation' => [
                    'id' => 'getChatConversations',
                    'method' => 'GET',
                    'path' => '/2/chat/conversations',
                    'parameters' => [
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'chat_conversation.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_chat_conversation' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateChatConversation',
                'type' => 'write',
                'name' => 'Create Chat Conversation',
                'description' => 'Create Chat Group Conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'action_signatures' => [
                                'type' => 'array',
                                'description' => 'Cryptographic signatures for the create action.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => false,
                            ],
                            'base64_encoded_key_rotation' => [
                                'type' => 'string',
                                'description' => 'Base64-encoded key rotation payload.',
                                'required' => false,
                            ],
                            'conversation_id' => [
                                'type' => 'string',
                                'description' => 'Client-generated conversation ID.',
                                'required' => true,
                            ],
                            'conversation_key_version' => [
                                'type' => 'string',
                                'description' => 'Version of the conversation encryption key.',
                                'required' => true,
                            ],
                            'conversation_participant_keys' => [
                                'type' => 'array',
                                'description' => 'Encrypted conversation keys for each participant.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => true,
                            ],
                            'group_admins' => [
                                'type' => 'array',
                                'description' => 'User IDs of group admins. Defaults to the creator if omitted.',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => false,
                            ],
                            'group_avatar_url' => [
                                'type' => 'string',
                                'description' => 'URL of the avatar image for the group conversation.',
                                'required' => false,
                            ],
                            'group_description' => [
                                'type' => 'string',
                                'description' => 'Description for the group conversation.',
                                'required' => false,
                            ],
                            'group_members' => [
                                'type' => 'array',
                                'description' => 'User IDs of group members to include in the conversation.',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => true,
                            ],
                            'group_name' => [
                                'type' => 'string',
                                'description' => 'Display name for the group conversation.',
                                'required' => false,
                            ],
                            'ttl_msec' => [
                                'type' => 'string',
                                'description' => 'Message time-to-live in milliseconds. Messages expire after this duration.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createChatConversation',
                'operation' => [
                    'id' => 'createChatConversation',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/group',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_initialize_chat_group' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XInitializeChatGroup',
                'type' => 'write',
                'name' => 'Initialize Chat Group',
                'description' => 'Initialize Chat Group',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'initializeChatGroup',
                'operation' => [
                    'id' => 'initializeChatGroup',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/group/initialize',
                    'parameters' => [
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_chat_conversation' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetChatConversation',
                'type' => 'read',
                'name' => 'Get Chat Conversation',
                'description' => 'Get Chat Conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Maximum number of message events to return.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token for pagination to retrieve the next page of results.',
                    ],
                    'chat_message_event.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of ChatMessageEvent fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getChatConversation',
                'operation' => [
                    'id' => 'getChatConversation',
                    'method' => 'GET',
                    'path' => '/2/chat/conversations/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'chat_message_event.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_initialize_chat_conversation_keys' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XInitializeChatConversationKeys',
                'type' => 'write',
                'name' => 'Initialize Chat Conversation Keys',
                'description' => 'Initialize Conversation Keys',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'action_signatures' => [
                                'type' => 'array',
                                'description' => 'Cryptographic signatures for the key initialization action.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => false,
                            ],
                            'base64_encoded_key_rotation' => [
                                'type' => 'string',
                                'description' => 'Base64-encoded key rotation payload for ratchet tree key management.',
                                'required' => false,
                            ],
                            'conversation_key_version' => [
                                'type' => 'string',
                                'description' => 'Version of the conversation encryption key (typically a timestamp in milliseconds).',
                                'required' => true,
                            ],
                            'conversation_participant_keys' => [
                                'type' => 'array',
                                'description' => 'The conversation key encrypted for each participant using their public key.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'initializeChatConversationKeys',
                'operation' => [
                    'id' => 'initializeChatConversationKeys',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/{id}/keys',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_add_chat_group_members' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XAddChatGroupMembers',
                'type' => 'write',
                'name' => 'Add Chat Group Members',
                'description' => 'Add members to a Chat group conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Chat group conversation ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'action_signatures' => [
                                'type' => 'array',
                                'description' => 'Cryptographic signatures for the add-members action.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => false,
                            ],
                            'conversation_key_version' => [
                                'type' => 'string',
                                'description' => 'Version of the new rotated conversation key.',
                                'required' => false,
                            ],
                            'conversation_participant_keys' => [
                                'type' => 'array',
                                'description' => 'Encrypted conversation keys for each new participant after key rotation.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => false,
                            ],
                            'encrypted_avatar_url' => [
                                'type' => 'string',
                                'description' => 'Re-encrypted group avatar URL with new conversation key.',
                                'required' => false,
                            ],
                            'encrypted_title' => [
                                'type' => 'string',
                                'description' => 'Re-encrypted group title with new conversation key.',
                                'required' => false,
                            ],
                            'user_ids' => [
                                'type' => 'array',
                                'description' => 'List of user IDs to add to the group conversation.',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'addChatGroupMembers',
                'operation' => [
                    'id' => 'addChatGroupMembers',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/{id}/members',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_send_chat_message' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSendChatMessage',
                'type' => 'write',
                'name' => 'Send Chat Message',
                'description' => 'Send Chat Message',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'conversation_token' => [
                                'type' => 'string',
                                'description' => 'Optional conversation token.',
                                'required' => false,
                            ],
                            'encoded_message_create_event' => [
                                'type' => 'string',
                                'description' => 'Base64-encoded Thrift MessageCreateEvent containing encrypted message contents.',
                                'required' => true,
                            ],
                            'encoded_message_event_signature' => [
                                'type' => 'string',
                                'description' => 'Base64-encoded Thrift MessageEventSignature for message verification.',
                                'required' => false,
                            ],
                            'message_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier for this message.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'sendChatMessage',
                'operation' => [
                    'id' => 'sendChatMessage',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/{id}/messages',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_mark_chat_conversation_read' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XMarkChatConversationRead',
                'type' => 'write',
                'name' => 'Mark Chat Conversation Read',
                'description' => 'Mark Conversation as Read',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'seen_until_sequence_id' => [
                                'type' => 'string',
                                'description' => 'The sequence ID of the last message to mark as read up to.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'markChatConversationRead',
                'operation' => [
                    'id' => 'markChatConversationRead',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/{id}/read',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_send_chat_typing_indicator' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSendChatTypingIndicator',
                'type' => 'write',
                'name' => 'Send Chat Typing Indicator',
                'description' => 'Send Typing Indicator',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                ],
                'operation_id' => 'sendChatTypingIndicator',
                'operation' => [
                    'id' => 'sendChatTypingIndicator',
                    'method' => 'POST',
                    'path' => '/2/chat/conversations/{id}/typing',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_chat_media_upload_initialize' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XChatMediaUploadInitialize',
                'type' => 'write',
                'name' => 'Chat Media Upload Initialize',
                'description' => 'Initialize Chat Media Upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'conversation_id' => [
                                'type' => 'string',
                                'description' => 'XChat conversation identifier for the upload.',
                                'required' => false,
                            ],
                            'total_bytes' => [
                                'type' => 'integer',
                                'description' => 'Total size of the media upload in bytes.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'chatMediaUploadInitialize',
                'operation' => [
                    'id' => 'chatMediaUploadInitialize',
                    'method' => 'POST',
                    'path' => '/2/chat/media/upload/initialize',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_chat_media_upload_append' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XChatMediaUploadAppend',
                'type' => 'write',
                'name' => 'Chat Media Upload Append',
                'description' => 'Append Chat Media Upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The session/resume id from initialize.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'conversation_id' => [
                                'type' => 'string',
                                'description' => 'XChat conversation identifier for the upload.',
                                'required' => true,
                            ],
                            'media' => [
                                'type' => 'string',
                                'description' => 'The file to upload.',
                                'required' => true,
                            ],
                            'media_hash_key' => [
                                'type' => 'string',
                                'description' => 'Media hash key returned from initialize.',
                                'required' => true,
                            ],
                            'segment_index' => [
                                'type' => 'string',
                                'description' => 'An integer value representing the media upload segment.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'chatMediaUploadAppend',
                'operation' => [
                    'id' => 'chatMediaUploadAppend',
                    'method' => 'POST',
                    'path' => '/2/chat/media/upload/{id}/append',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'multipart',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_chat_media_upload_finalize' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XChatMediaUploadFinalize',
                'type' => 'write',
                'name' => 'Chat Media Upload Finalize',
                'description' => 'Finalize Chat Media Upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The session/resume id from initialize.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'conversation_id' => [
                                'type' => 'string',
                                'description' => 'XChat conversation identifier for the upload.',
                                'required' => false,
                            ],
                            'media_hash_key' => [
                                'type' => 'string',
                                'description' => 'Media hash key returned from initialize.',
                                'required' => false,
                            ],
                            'message_id' => [
                                'type' => 'string',
                                'description' => 'Optional message identifier associated with the upload.',
                                'required' => false,
                            ],
                            'num_parts' => [
                                'type' => 'string',
                                'description' => 'Total number of uploaded parts as a numeric string.',
                                'required' => false,
                            ],
                            'ttl_msec' => [
                                'type' => 'string',
                                'description' => 'Optional TTL for the media in milliseconds.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'chatMediaUploadFinalize',
                'operation' => [
                    'id' => 'chatMediaUploadFinalize',
                    'method' => 'POST',
                    'path' => '/2/chat/media/upload/{id}/finalize',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_chat_media_download' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XChatMediaDownload',
                'type' => 'read',
                'name' => 'Chat Media Download',
                'description' => 'Download Chat Media',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
                    ],
                    'media_hash_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media hash key returned from the upload initialize step.',
                    ],
                ],
                'operation_id' => 'chatMediaDownload',
                'operation' => [
                    'id' => 'chatMediaDownload',
                    'method' => 'GET',
                    'path' => '/2/chat/media/{id}/{media_hash_key}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'media_hash_key',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_communities' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchCommunities',
                'type' => 'read',
                'name' => 'Search Communities',
                'description' => 'Search Communities',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Query to search communities.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of search results to be returned by a request.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'community.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Community fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchCommunities',
                'operation' => [
                    'id' => 'searchCommunities',
                    'method' => 'GET',
                    'path' => '/2/communities/search',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'community.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Communities',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_communities_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetCommunitiesById',
                'type' => 'read',
                'name' => 'Get Communities By ID',
                'description' => 'Get Community by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Community.',
                    ],
                    'community.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Community fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getCommunitiesById',
                'operation' => [
                    'id' => 'getCommunitiesById',
                    'method' => 'GET',
                    'path' => '/2/communities/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'community.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Communities',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_compliance_jobs' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetComplianceJobs',
                'type' => 'read',
                'name' => 'Get Compliance Jobs',
                'description' => 'Get Compliance Jobs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'type' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Type of Compliance Job to list.',
                        'enum' => [
                            'tweets',
                            'users',
                        ],
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Status of Compliance Job to list.',
                        'enum' => [
                            'created',
                            'in_progress',
                            'failed',
                            'complete',
                        ],
                    ],
                    'compliance_job.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of ComplianceJob fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getComplianceJobs',
                'operation' => [
                    'id' => 'getComplianceJobs',
                    'method' => 'GET',
                    'path' => '/2/compliance/jobs',
                    'parameters' => [
                        [
                            'name' => 'type',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'status',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'compliance_job.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'async_job',
                    'tags' => [
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'async_job',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_compliance_jobs' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateComplianceJobs',
                'type' => 'write',
                'name' => 'Create Compliance Jobs',
                'description' => 'Create Compliance Job',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'name' => [
                                'type' => 'string',
                                'description' => 'User-provided name for a compliance job.',
                                'required' => false,
                            ],
                            'resumable' => [
                                'type' => 'boolean',
                                'description' => 'If true, this endpoint will return a pre-signed URL with resumable uploads enabled.',
                                'required' => false,
                            ],
                            'type' => [
                                'type' => 'string',
                                'description' => 'Type of compliance job to list.',
                                'enum' => [
                                    'tweets',
                                    'users',
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createComplianceJobs',
                'operation' => [
                    'id' => 'createComplianceJobs',
                    'method' => 'POST',
                    'path' => '/2/compliance/jobs',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'async_job',
                    'tags' => [
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'async_job',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_compliance_jobs_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetComplianceJobsById',
                'type' => 'read',
                'name' => 'Get Compliance Jobs By ID',
                'description' => 'Get Compliance Job by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Compliance Job to retrieve.',
                    ],
                    'compliance_job.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of ComplianceJob fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getComplianceJobsById',
                'operation' => [
                    'id' => 'getComplianceJobsById',
                    'method' => 'GET',
                    'path' => '/2/compliance/jobs/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'compliance_job.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'async_job',
                    'tags' => [
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'async_job',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_connections_by_uuids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteConnectionsByUuids',
                'type' => 'write',
                'name' => 'Delete Connections By Uuids',
                'description' => 'Terminate multiple connections',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'uuids' => [
                                'type' => 'array',
                                'description' => 'Array of connection UUIDs to terminate',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'deleteConnectionsByUuids',
                'operation' => [
                    'id' => 'deleteConnectionsByUuids',
                    'method' => 'DELETE',
                    'path' => '/2/connections',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Connections',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_connection_history' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetConnectionHistory',
                'type' => 'read',
                'name' => 'Get Connection History',
                'description' => 'Get Connection History',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by connection status. Use \'active\' for current connections, \'inactive\' for historical/disconnected connections, or \'all\' for both.',
                        'enum' => [
                            'active',
                            'inactive',
                            'all',
                        ],
                    ],
                    'endpoints' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'Filter by streaming endpoint. Specify one or more endpoint names to filter results.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results to return per page.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Token for paginating through results. Use the value from \'next_token\' in the previous response.',
                    ],
                    'connection.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Connection fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getConnectionHistory',
                'operation' => [
                    'id' => 'getConnectionHistory',
                    'method' => 'GET',
                    'path' => '/2/connections',
                    'parameters' => [
                        [
                            'name' => 'status',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'endpoints',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'connection.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Connections',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_all_connections' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteAllConnections',
                'type' => 'write',
                'name' => 'Delete All Connections',
                'description' => 'Terminate all connections',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'deleteAllConnections',
                'operation' => [
                    'id' => 'deleteAllConnections',
                    'method' => 'DELETE',
                    'path' => '/2/connections/all',
                    'parameters' => [
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Connections',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_connections_by_endpoint' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteConnectionsByEndpoint',
                'type' => 'write',
                'name' => 'Delete Connections By Endpoint',
                'description' => 'Terminate connections by endpoint',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'endpoint_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The endpoint ID to terminate connections for.',
                        'enum' => [
                            'filtered_stream',
                            'sample_stream',
                            'sample10_stream',
                            'firehose_stream',
                            'tweets_compliance_stream',
                            'users_compliance_stream',
                            'tweet_label_stream',
                            'firehose_stream_lang_en',
                            'firehose_stream_lang_ja',
                            'firehose_stream_lang_ko',
                            'firehose_stream_lang_pt',
                            'likes_firehose_stream',
                            'likes_sample10_stream',
                            'likes_compliance_stream',
                        ],
                    ],
                ],
                'operation_id' => 'deleteConnectionsByEndpoint',
                'operation' => [
                    'id' => 'deleteConnectionsByEndpoint',
                    'method' => 'DELETE',
                    'path' => '/2/connections/{endpoint_id}',
                    'parameters' => [
                        [
                            'name' => 'endpoint_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Connections',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_direct_messages_conversation' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateDirectMessagesConversation',
                'type' => 'write',
                'name' => 'Create Direct Messages Conversation',
                'description' => 'Create DM conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'conversation_type' => [
                                'type' => 'string',
                                'description' => 'The conversation type that is being created.',
                                'enum' => [
                                    'Group',
                                ],
                                'required' => true,
                            ],
                            'message' => [
                                'type' => 'object',
                                'description' => '',
                                'properties' => [
                                    'attachments' => [
                                        'type' => 'array',
                                        'description' => 'Attachments to a DM Event.',
                                        'items' => [
                                            'type' => 'object',
                                        ],
                                        'required' => false,
                                    ],
                                    'text' => [
                                        'type' => 'string',
                                        'description' => 'Text of the message.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => true,
                            ],
                            'participant_ids' => [
                                'type' => 'array',
                                'description' => 'Participants for the DM Conversation.',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createDirectMessagesConversation',
                'operation' => [
                    'id' => 'createDirectMessagesConversation',
                    'method' => 'POST',
                    'path' => '/2/dm_conversations',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_dm_conversations_media_download' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDmConversationsMediaDownload',
                'type' => 'read',
                'name' => 'DM Conversations Media Download',
                'description' => 'Download DM Media',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'dm_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the Direct Message event containing the media.',
                    ],
                    'media_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique identifier of the media attached to the Direct Message.',
                    ],
                    'resource_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The resource identifier of the media file, including file extension (e.g. \'hVJQTwig.jpg\').',
                    ],
                ],
                'operation_id' => 'dmConversationsMediaDownload',
                'operation' => [
                    'id' => 'dmConversationsMediaDownload',
                    'method' => 'GET',
                    'path' => '/2/dm_conversations/media/{dm_id}/{media_id}/{resource_id}',
                    'parameters' => [
                        [
                            'name' => 'dm_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'media_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'resource_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'dm.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'dm.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_direct_messages_events_by_participant_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetDirectMessagesEventsByParticipantId',
                'type' => 'read',
                'name' => 'Get Direct Messages Events By Participant ID',
                'description' => 'Get DM events for a DM conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'participant_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the participant user for the One to One DM conversation.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'event_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of event_types to include in the results.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'dm_event.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of DmEvent fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getDirectMessagesEventsByParticipantId',
                'operation' => [
                    'id' => 'getDirectMessagesEventsByParticipantId',
                    'method' => 'GET',
                    'path' => '/2/dm_conversations/with/{participant_id}/dm_events',
                    'parameters' => [
                        [
                            'name' => 'participant_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'event_types',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'dm_event.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_direct_messages_by_participant_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateDirectMessagesByParticipantId',
                'type' => 'write',
                'name' => 'Create Direct Messages By Participant ID',
                'description' => 'Create DM message by participant ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'participant_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the recipient user that will receive the DM.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'attachments' => [
                                'type' => 'array',
                                'description' => 'Attachments to a DM Event.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => true,
                            ],
                            'text' => [
                                'type' => 'string',
                                'description' => 'Text of the message.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createDirectMessagesByParticipantId',
                'operation' => [
                    'id' => 'createDirectMessagesByParticipantId',
                    'method' => 'POST',
                    'path' => '/2/dm_conversations/with/{participant_id}/messages',
                    'parameters' => [
                        [
                            'name' => 'participant_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_direct_messages_by_conversation_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateDirectMessagesByConversationId',
                'type' => 'write',
                'name' => 'Create Direct Messages By Conversation ID',
                'description' => 'Create DM message by conversation ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'dm_conversation_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The DM Conversation ID.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'attachments' => [
                                'type' => 'array',
                                'description' => 'Attachments to a DM Event.',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => true,
                            ],
                            'text' => [
                                'type' => 'string',
                                'description' => 'Text of the message.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createDirectMessagesByConversationId',
                'operation' => [
                    'id' => 'createDirectMessagesByConversationId',
                    'method' => 'POST',
                    'path' => '/2/dm_conversations/{dm_conversation_id}/messages',
                    'parameters' => [
                        [
                            'name' => 'dm_conversation_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_direct_messages_events_by_conversation_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetDirectMessagesEventsByConversationId',
                'type' => 'read',
                'name' => 'Get Direct Messages Events By Conversation ID',
                'description' => 'Get DM events for a DM conversation',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The DM conversation ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'event_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of event_types to include in the results.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'dm_event.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of DmEvent fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getDirectMessagesEventsByConversationId',
                'operation' => [
                    'id' => 'getDirectMessagesEventsByConversationId',
                    'method' => 'GET',
                    'path' => '/2/dm_conversations/{id}/dm_events',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'event_types',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'dm_event.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_direct_messages_events' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetDirectMessagesEvents',
                'type' => 'read',
                'name' => 'Get Direct Messages Events',
                'description' => 'Get DM events',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'event_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of event_types to include in the results.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'dm_event.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of DmEvent fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getDirectMessagesEvents',
                'operation' => [
                    'id' => 'getDirectMessagesEvents',
                    'method' => 'GET',
                    'path' => '/2/dm_events',
                    'parameters' => [
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'event_types',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'dm_event.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_direct_messages_events' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteDirectMessagesEvents',
                'type' => 'write',
                'name' => 'Delete Direct Messages Events',
                'description' => 'Delete DM event',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the direct-message event to delete.',
                    ],
                ],
                'operation_id' => 'deleteDirectMessagesEvents',
                'operation' => [
                    'id' => 'deleteDirectMessagesEvents',
                    'method' => 'DELETE',
                    'path' => '/2/dm_events/{event_id}',
                    'parameters' => [
                        [
                            'name' => 'event_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'dm.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'dm.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_direct_messages_events_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetDirectMessagesEventsById',
                'type' => 'read',
                'name' => 'Get Direct Messages Events By ID',
                'description' => 'Get DM event by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'event_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'dm event id.',
                    ],
                    'dm_event.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of DmEvent fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getDirectMessagesEventsById',
                'operation' => [
                    'id' => 'getDirectMessagesEventsById',
                    'method' => 'GET',
                    'path' => '/2/dm_events/{event_id}',
                    'parameters' => [
                        [
                            'name' => 'event_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'dm_event.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Direct Messages',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_evaluate_community_notes' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XEvaluateCommunityNotes',
                'type' => 'write',
                'name' => 'Evaluate Community Notes',
                'description' => 'Evaluate a Community Note',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'note_text' => [
                                'type' => 'string',
                                'description' => 'Text for the community note.',
                                'required' => true,
                            ],
                            'post_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'evaluateCommunityNotes',
                'operation' => [
                    'id' => 'evaluateCommunityNotes',
                    'method' => 'POST',
                    'path' => '/2/evaluate_note',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Community Notes',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_insights28_hr' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetInsights28Hr',
                'type' => 'read',
                'name' => 'Get Insights28 Hr',
                'description' => 'Get 28-hour Post insights',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'tweet_ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'List of PostIds for 28hr metrics.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'granularity of metrics response.',
                        'enum' => [
                            'Daily',
                            'Hourly',
                            'Weekly',
                            'Total',
                        ],
                    ],
                    'requested_metrics' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'request metrics for historical request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'engagement.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Engagement fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getInsights28Hr',
                'operation' => [
                    'id' => 'getInsights28Hr',
                    'method' => 'GET',
                    'path' => '/2/insights/28hr',
                    'parameters' => [
                        [
                            'name' => 'tweet_ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'requested_metrics',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'engagement.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_insights_historical' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetInsightsHistorical',
                'type' => 'read',
                'name' => 'Get Insights Historical',
                'description' => 'Get historical Post insights',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'tweet_ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'List of PostIds for historical metrics.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the end of the time range.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the start of the time range.',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'granularity of metrics response.',
                        'enum' => [
                            'Daily',
                            'Hourly',
                            'Weekly',
                            'Total',
                        ],
                    ],
                    'requested_metrics' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'request metrics for historical request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'engagement.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Engagement fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getInsightsHistorical',
                'operation' => [
                    'id' => 'getInsightsHistorical',
                    'method' => 'GET',
                    'path' => '/2/insights/historical',
                    'parameters' => [
                        [
                            'name' => 'tweet_ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'requested_metrics',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'engagement.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_likes_compliance' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamLikesCompliance',
                'type' => 'read',
                'name' => 'Stream Likes Compliance',
                'description' => 'Stream Likes compliance data',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Likes Compliance events will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp from which the Likes Compliance events will be provided.',
                    ],
                ],
                'operation_id' => 'streamLikesCompliance',
                'operation' => [
                    'id' => 'streamLikesCompliance',
                    'method' => 'GET',
                    'path' => '/2/likes/compliance/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_likes_firehose' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamLikesFirehose',
                'type' => 'read',
                'name' => 'Stream Likes Firehose',
                'description' => 'Stream all Likes',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Likes will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'like_with_tweet_author.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of LikeWithTweetAuthor fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamLikesFirehose',
                'operation' => [
                    'id' => 'streamLikesFirehose',
                    'method' => 'GET',
                    'path' => '/2/likes/firehose/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'like_with_tweet_author.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Likes',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_likes_sample10' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamLikesSample10',
                'type' => 'read',
                'name' => 'Stream Likes Sample10',
                'description' => 'Stream sampled Likes',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Likes will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'like_with_tweet_author.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of LikeWithTweetAuthor fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamLikesSample10',
                'operation' => [
                    'id' => 'streamLikesSample10',
                    'method' => 'GET',
                    'path' => '/2/likes/sample10/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'like_with_tweet_author.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Likes',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateLists',
                'type' => 'write',
                'name' => 'Create Lists',
                'description' => 'Create List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'description' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => false,
                            ],
                            'name' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => true,
                            ],
                            'private' => [
                                'type' => 'boolean',
                                'description' => '',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createLists',
                'operation' => [
                    'id' => 'createLists',
                    'method' => 'POST',
                    'path' => '/2/lists',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteLists',
                'type' => 'write',
                'name' => 'Delete Lists',
                'description' => 'Delete List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List to delete.',
                    ],
                ],
                'operation_id' => 'deleteLists',
                'operation' => [
                    'id' => 'deleteLists',
                    'method' => 'DELETE',
                    'path' => '/2/lists/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_lists_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetListsById',
                'type' => 'read',
                'name' => 'Get Lists By ID',
                'description' => 'Get List by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List.',
                    ],
                    'list.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of List fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getListsById',
                'operation' => [
                    'id' => 'getListsById',
                    'method' => 'GET',
                    'path' => '/2/lists/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_update_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUpdateLists',
                'type' => 'write',
                'name' => 'Update Lists',
                'description' => 'Update List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List to modify.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'description' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => false,
                            ],
                            'name' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => false,
                            ],
                            'private' => [
                                'type' => 'boolean',
                                'description' => '',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'updateLists',
                'operation' => [
                    'id' => 'updateLists',
                    'method' => 'PUT',
                    'path' => '/2/lists/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_lists_followers' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetListsFollowers',
                'type' => 'read',
                'name' => 'Get Lists Followers',
                'description' => 'Get List followers',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getListsFollowers',
                'operation' => [
                    'id' => 'getListsFollowers',
                    'method' => 'GET',
                    'path' => '/2/lists/{id}/followers',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_lists_members' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetListsMembers',
                'type' => 'read',
                'name' => 'Get Lists Members',
                'description' => 'Get List members',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getListsMembers',
                'operation' => [
                    'id' => 'getListsMembers',
                    'method' => 'GET',
                    'path' => '/2/lists/{id}/members',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_add_lists_member' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XAddListsMember',
                'type' => 'write',
                'name' => 'Add Lists Member',
                'description' => 'Add List member',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List for which to add a member.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'user_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this User. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'addListsMember',
                'operation' => [
                    'id' => 'addListsMember',
                    'method' => 'POST',
                    'path' => '/2/lists/{id}/members',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_remove_lists_member_by_user_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XRemoveListsMemberByUserId',
                'type' => 'write',
                'name' => 'Remove Lists Member By User ID',
                'description' => 'Remove List member',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List to remove a member.',
                    ],
                    'user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of User that will be removed from the List.',
                    ],
                ],
                'operation_id' => 'removeListsMemberByUserId',
                'operation' => [
                    'id' => 'removeListsMemberByUserId',
                    'method' => 'DELETE',
                    'path' => '/2/lists/{id}/members/{user_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_lists_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetListsPosts',
                'type' => 'read',
                'name' => 'Get Lists Posts',
                'description' => 'Get List Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getListsPosts',
                'operation' => [
                    'id' => 'getListsPosts',
                    'method' => 'GET',
                    'path' => '/2/lists/{id}/tweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Lists',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_media_by_media_keys' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetMediaByMediaKeys',
                'type' => 'read',
                'name' => 'Get Media By Media Keys',
                'description' => 'Get Media by media keys',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'media_keys' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A comma separated list of Media Keys. Up to 100 are allowed in a single request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getMediaByMediaKeys',
                'operation' => [
                    'id' => 'getMediaByMediaKeys',
                    'method' => 'GET',
                    'path' => '/2/media',
                    'parameters' => [
                        [
                            'name' => 'media_keys',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_media_analytics' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetMediaAnalytics',
                'type' => 'read',
                'name' => 'Get Media Analytics',
                'description' => 'Get Media analytics',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'media_keys' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A comma separated list of Media Keys. Up to 100 are allowed in a single request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the end of the time range.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the start of the time range.',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The granularity for the search counts results.',
                        'enum' => [
                            'hourly',
                            'daily',
                            'total',
                        ],
                    ],
                    'media_analytics.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of MediaAnalytics fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getMediaAnalytics',
                'operation' => [
                    'id' => 'getMediaAnalytics',
                    'method' => 'GET',
                    'path' => '/2/media/analytics',
                    'parameters' => [
                        [
                            'name' => 'media_keys',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'media_analytics.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_media_metadata' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateMediaMetadata',
                'type' => 'write',
                'name' => 'Create Media Metadata',
                'description' => 'Create Media metadata',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this Media.',
                                'required' => true,
                            ],
                            'metadata' => [
                                'type' => 'object',
                                'description' => '',
                                'properties' => [
                                    'allow_download_status' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'allow_download' => [
                                                'type' => 'boolean',
                                                'description' => '',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'alt_text' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'text' => [
                                                'type' => 'string',
                                                'description' => 'Description of media ( <= 1000 characters )',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'audience_policy' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'creator_subscriptions' => [
                                                'type' => 'array',
                                                'description' => '',
                                                'items' => [
                                                    'type' => 'string',
                                                ],
                                                'required' => false,
                                            ],
                                            'x_subscriptions' => [
                                                'type' => 'array',
                                                'description' => '',
                                                'items' => [
                                                    'type' => 'string',
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'content_expiration' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'timestamp_sec' => [
                                                'type' => 'number',
                                                'description' => 'Expiration time for content as a Unix timestamp in seconds',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'domain_restrictions' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'whitelist' => [
                                                'type' => 'array',
                                                'description' => 'List of whitelisted domains',
                                                'items' => [
                                                    'type' => 'string',
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'found_media_origin' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'id' => [
                                                'type' => 'string',
                                                'description' => 'Unique Identifier of media within provider ( <= 24 characters ))',
                                                'required' => false,
                                            ],
                                            'provider' => [
                                                'type' => 'string',
                                                'description' => 'The media provider (e.g., \'giphy\') that sourced the media ( <= 8 Characters )',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'geo_restrictions' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'blacklisted_country_codes' => [
                                                'type' => 'array',
                                                'description' => 'List of blacklisted country codes',
                                                'items' => [
                                                    'type' => 'string',
                                                ],
                                                'required' => false,
                                            ],
                                            'whitelisted_country_codes' => [
                                                'type' => 'array',
                                                'description' => 'List of whitelisted country codes',
                                                'items' => [
                                                    'type' => 'string',
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'management_info' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'managed' => [
                                                'type' => 'boolean',
                                                'description' => 'Indicates if the media is managed by Media Studio',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'preview_image' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'media_key' => [
                                                'type' => 'object',
                                                'description' => '',
                                                'properties' => [
                                                    'media' => [
                                                        'type' => 'string',
                                                        'description' => 'The unique identifier of this Media.',
                                                        'required' => false,
                                                    ],
                                                    'media_category' => [
                                                        'type' => 'string',
                                                        'description' => 'The media category of media',
                                                        'enum' => [
                                                            'TweetImage',
                                                        ],
                                                        'required' => false,
                                                    ],
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'sensitive_media_warning' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'adult_content' => [
                                                'type' => 'boolean',
                                                'description' => 'Indicates if the content contains adult material',
                                                'required' => false,
                                            ],
                                            'graphic_violence' => [
                                                'type' => 'boolean',
                                                'description' => 'Indicates if the content depicts graphic violence',
                                                'required' => false,
                                            ],
                                            'other' => [
                                                'type' => 'boolean',
                                                'description' => 'Indicates if the content has other sensitive characteristics',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'shared_info' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'shared' => [
                                                'type' => 'boolean',
                                                'description' => 'Indicates if the media is shared in direct messages',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'sticker_info' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'stickers' => [
                                                'type' => 'array',
                                                'description' => 'Stickers list must not be empty and should not exceed 25',
                                                'items' => [
                                                    'type' => 'object',
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'upload_source' => [
                                        'type' => 'object',
                                        'description' => '',
                                        'properties' => [
                                            'upload_source' => [
                                                'type' => 'string',
                                                'description' => 'Records the source (e.g., app, device) from which the media was uploaded',
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createMediaMetadata',
                'operation' => [
                    'id' => 'createMediaMetadata',
                    'method' => 'POST',
                    'path' => '/2/media/metadata',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_media_subtitles' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteMediaSubtitles',
                'type' => 'write',
                'name' => 'Delete Media Subtitles',
                'description' => 'Delete Media subtitles',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this Media.',
                                'required' => false,
                            ],
                            'language_code' => [
                                'type' => 'string',
                                'description' => 'The language code should be a BCP47 code (e.g. \'EN", "SP")',
                                'required' => false,
                            ],
                            'media_category' => [
                                'type' => 'string',
                                'description' => 'The media category of uploaded media to which subtitles should be added/deleted',
                                'enum' => [
                                    'AmplifyVideo',
                                    'TweetVideo',
                                ],
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'deleteMediaSubtitles',
                'operation' => [
                    'id' => 'deleteMediaSubtitles',
                    'method' => 'DELETE',
                    'path' => '/2/media/subtitles',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_media_subtitles' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateMediaSubtitles',
                'type' => 'write',
                'name' => 'Create Media Subtitles',
                'description' => 'Create Media subtitles',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this Media.',
                                'required' => false,
                            ],
                            'media_category' => [
                                'type' => 'string',
                                'description' => 'The media category of uploaded media to which subtitles should be added/deleted',
                                'enum' => [
                                    'AmplifyVideo',
                                    'TweetVideo',
                                ],
                                'required' => false,
                            ],
                            'subtitles' => [
                                'type' => 'object',
                                'description' => '',
                                'properties' => [
                                    'display_name' => [
                                        'type' => 'string',
                                        'description' => 'Language name in a human readable form',
                                        'required' => false,
                                    ],
                                    'id' => [
                                        'type' => 'string',
                                        'description' => 'The unique identifier of this Media.',
                                        'required' => false,
                                    ],
                                    'language_code' => [
                                        'type' => 'string',
                                        'description' => 'The language code should be a BCP47 code (e.g. \'EN", "SP")',
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createMediaSubtitles',
                'operation' => [
                    'id' => 'createMediaSubtitles',
                    'method' => 'POST',
                    'path' => '/2/media/subtitles',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_media_upload_status' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetMediaUploadStatus',
                'type' => 'read',
                'name' => 'Get Media Upload Status',
                'description' => 'Get Media upload status',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'media_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Media id for the requested media upload status.',
                    ],
                    'command' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The command for the media upload request.',
                        'enum' => [
                            'STATUS',
                        ],
                    ],
                ],
                'operation_id' => 'getMediaUploadStatus',
                'operation' => [
                    'id' => 'getMediaUploadStatus',
                    'method' => 'GET',
                    'path' => '/2/media/upload',
                    'parameters' => [
                        [
                            'name' => 'media_id',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'command',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_media_upload' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XMediaUpload',
                'type' => 'write',
                'name' => 'Media Upload',
                'description' => 'Upload media',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'additional_owners' => [
                                'type' => 'array',
                                'description' => '',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => false,
                            ],
                            'media' => [
                                'type' => 'string',
                                'description' => 'The file to upload.',
                                'required' => true,
                            ],
                            'media_category' => [
                                'type' => 'string',
                                'description' => 'A string enum value which identifies a media use-case. This identifier is used to enforce use-case specific constraints (e.g. file size) and enable advanced features.',
                                'enum' => [
                                    'tweet_image',
                                    'dm_image',
                                    'subtitles',
                                ],
                                'required' => true,
                            ],
                            'media_type' => [
                                'type' => 'string',
                                'description' => 'The type of image or subtitle.',
                                'enum' => [
                                    'text/srt',
                                    'text/vtt',
                                    'image/jpeg',
                                    'image/bmp',
                                    'image/png',
                                    'image/webp',
                                    'image/pjpeg',
                                    'image/tiff',
                                ],
                                'required' => false,
                            ],
                            'shared' => [
                                'type' => 'boolean',
                                'description' => 'Whether this media is shared or not.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'mediaUpload',
                'operation' => [
                    'id' => 'mediaUpload',
                    'method' => 'POST',
                    'path' => '/2/media/upload',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'multipart',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_initialize_media_upload' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XInitializeMediaUpload',
                'type' => 'write',
                'name' => 'Initialize Media Upload',
                'description' => 'Initialize media upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'additional_owners' => [
                                'type' => 'array',
                                'description' => '',
                                'items' => [
                                    'type' => 'string',
                                ],
                                'required' => false,
                            ],
                            'media_category' => [
                                'type' => 'string',
                                'description' => 'A string enum value which identifies a media use-case. This identifier is used to enforce use-case specific constraints (e.g. file size, video duration) and enable advanced features.',
                                'enum' => [
                                    'amplify_video',
                                    'tweet_gif',
                                    'tweet_image',
                                    'tweet_video',
                                    'dm_gif',
                                    'dm_image',
                                    'dm_video',
                                    'subtitles',
                                ],
                                'required' => false,
                            ],
                            'media_type' => [
                                'type' => 'string',
                                'description' => 'The type of media.',
                                'enum' => [
                                    'video/mp4',
                                    'video/webm',
                                    'video/mp2t',
                                    'video/quicktime',
                                    'text/srt',
                                    'text/vtt',
                                    'image/jpeg',
                                    'image/gif',
                                    'image/bmp',
                                    'image/png',
                                    'image/webp',
                                    'image/pjpeg',
                                    'image/tiff',
                                    'model/gltf-binary',
                                    'model/vnd.usdz+zip',
                                ],
                                'required' => false,
                            ],
                            'shared' => [
                                'type' => 'boolean',
                                'description' => 'Whether this media is shared or not.',
                                'required' => false,
                            ],
                            'total_bytes' => [
                                'type' => 'integer',
                                'description' => 'The total size of the media upload in bytes.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'initializeMediaUpload',
                'operation' => [
                    'id' => 'initializeMediaUpload',
                    'method' => 'POST',
                    'path' => '/2/media/upload/initialize',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_append_media_upload' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XAppendMediaUpload',
                'type' => 'write',
                'name' => 'Append Media Upload',
                'description' => 'Append Media upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media identifier for the media to perform the append operation.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'media' => [
                                'type' => 'string',
                                'description' => 'The file to upload.',
                                'required' => true,
                            ],
                            'segment_index' => [
                                'type' => 'string',
                                'description' => 'An integer value representing the media upload segment.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'appendMediaUpload',
                'operation' => [
                    'id' => 'appendMediaUpload',
                    'method' => 'POST',
                    'path' => '/2/media/upload/{id}/append',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'multipart',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_finalize_media_upload' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XFinalizeMediaUpload',
                'type' => 'write',
                'name' => 'Finalize Media Upload',
                'description' => 'Finalize Media upload',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The media id of the targeted media to finalize.',
                    ],
                ],
                'operation_id' => 'finalizeMediaUpload',
                'operation' => [
                    'id' => 'finalizeMediaUpload',
                    'method' => 'POST',
                    'path' => '/2/media/upload/{id}/finalize',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'media.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'media.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_media_by_media_key' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetMediaByMediaKey',
                'type' => 'read',
                'name' => 'Get Media By Media Key',
                'description' => 'Get Media by media key',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'media_key' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Media Key.',
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getMediaByMediaKey',
                'operation' => [
                    'id' => 'getMediaByMediaKey',
                    'method' => 'GET',
                    'path' => '/2/media/{media_key}',
                    'parameters' => [
                        [
                            'name' => 'media_key',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Media',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_news' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchNews',
                'type' => 'read',
                'name' => 'Search News',
                'description' => 'Search News',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The search query.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of results to return.',
                    ],
                    'max_age_hours' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum age of the News story to search for.',
                    ],
                    'news.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of News fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchNews',
                'operation' => [
                    'id' => 'searchNews',
                    'method' => 'GET',
                    'path' => '/2/news/search',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_age_hours',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'news.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'News',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_news' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetNews',
                'type' => 'read',
                'name' => 'Get News',
                'description' => 'Get news stories by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the news story.',
                    ],
                    'news.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of News fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getNews',
                'operation' => [
                    'id' => 'getNews',
                    'method' => 'GET',
                    'path' => '/2/news/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'news.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'News',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_community_notes' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateCommunityNotes',
                'type' => 'write',
                'name' => 'Create Community Notes',
                'description' => 'Create a Community Note',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'info' => [
                                'type' => 'object',
                                'description' => 'A X Community Note is a note on a Post.',
                                'properties' => [
                                    'classification' => [
                                        'type' => 'string',
                                        'description' => 'Community Note classification type.',
                                        'enum' => [
                                            'misinformed_or_potentially_misleading',
                                            'not_misleading',
                                        ],
                                        'required' => false,
                                    ],
                                    'is_media_note' => [
                                        'type' => 'boolean',
                                        'description' => 'Whether the note is a media note.',
                                        'required' => false,
                                    ],
                                    'misleading_tags' => [
                                        'type' => 'array',
                                        'description' => '',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'text' => [
                                        'type' => 'string',
                                        'description' => 'The text summary in the Community Note.',
                                        'required' => false,
                                    ],
                                    'trustworthy_sources' => [
                                        'type' => 'boolean',
                                        'description' => 'Whether the note provided trustworthy links.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => true,
                            ],
                            'post_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                            'test_mode' => [
                                'type' => 'boolean',
                                'description' => 'If true, the note being submitted is only for testing the capability of the bot, and won\'t be publicly visible. If false, the note being submitted will be a new proposed note on the product.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createCommunityNotes',
                'operation' => [
                    'id' => 'createCommunityNotes',
                    'method' => 'POST',
                    'path' => '/2/notes',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Community Notes',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_community_notes_written' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchCommunityNotesWritten',
                'type' => 'read',
                'name' => 'Search Community Notes Written',
                'description' => 'Search for Community Notes Written',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'test_mode' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'If true, return the notes the caller wrote for the test. If false, return the notes the caller wrote on the product.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination token to get next set of posts eligible for notes.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Max results to return.',
                    ],
                    'note.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Note fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchCommunityNotesWritten',
                'operation' => [
                    'id' => 'searchCommunityNotesWritten',
                    'method' => 'GET',
                    'path' => '/2/notes/search/notes_written',
                    'parameters' => [
                        [
                            'name' => 'test_mode',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'note.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Community Notes',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_eligible_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchEligiblePosts',
                'type' => 'read',
                'name' => 'Search Eligible Posts',
                'description' => 'Search for Posts Eligible for Community Notes',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'test_mode' => [
                        'type' => 'boolean',
                        'required' => true,
                        'description' => 'If true, return a list of posts that are for the test. If false, return a list of posts that the bots can write proposed notes on the product.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Pagination token to get next set of posts eligible for notes.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'Max results to return.',
                    ],
                    'post_selection' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The selection of posts to return. Valid values are \'feed_size: [small|large|xl|xxl], feed_lang: [en|es|...|all]\'. Default (if not specified) is \'feed_size: small, feed_lang: en\'. Only top AI writers have access to large, xl, and xxl size feeds.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchEligiblePosts',
                'operation' => [
                    'id' => 'searchEligiblePosts',
                    'method' => 'GET',
                    'path' => '/2/notes/search/posts_eligible_for_notes',
                    'parameters' => [
                        [
                            'name' => 'test_mode',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'post_selection',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Community Notes',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_community_notes' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteCommunityNotes',
                'type' => 'write',
                'name' => 'Delete Community Notes',
                'description' => 'Delete a Community Note',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The community note id to delete.',
                    ],
                ],
                'operation_id' => 'deleteCommunityNotes',
                'operation' => [
                    'id' => 'deleteCommunityNotes',
                    'method' => 'DELETE',
                    'path' => '/2/notes/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.write',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Community Notes',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.write',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_open_api_spec' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetOpenApiSpec',
                'type' => 'read',
                'name' => 'Get Open API Spec',
                'description' => 'Get OpenAPI Spec.',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'getOpenApiSpec',
                'operation' => [
                    'id' => 'getOpenApiSpec',
                    'method' => 'GET',
                    'path' => '/2/openapi.json',
                    'parameters' => [
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'General',
                    ],
                ],
                'auth_modes' => [
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_spaces_by_ids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetSpacesByIds',
                'type' => 'read',
                'name' => 'Get Spaces By Ids',
                'description' => 'Get Spaces by IDs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'The list of Space IDs to return.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'space.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Space fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'topic.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Topic fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getSpacesByIds',
                'operation' => [
                    'id' => 'getSpacesByIds',
                    'method' => 'GET',
                    'path' => '/2/spaces',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'space.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'topic.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_spaces_by_creator_ids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetSpacesByCreatorIds',
                'type' => 'read',
                'name' => 'Get Spaces By Creator Ids',
                'description' => 'Get Spaces by creator IDs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'user_ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'The IDs of Users to search through.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'space.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Space fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'topic.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Topic fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getSpacesByCreatorIds',
                'operation' => [
                    'id' => 'getSpacesByCreatorIds',
                    'method' => 'GET',
                    'path' => '/2/spaces/by/creator_ids',
                    'parameters' => [
                        [
                            'name' => 'user_ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'space.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'topic.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_spaces' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchSpaces',
                'type' => 'read',
                'name' => 'Search Spaces',
                'description' => 'Search Spaces',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The search query.',
                    ],
                    'state' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The state of Spaces to search for.',
                        'enum' => [
                            'live',
                            'scheduled',
                            'all',
                        ],
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of results to return.',
                    ],
                    'space.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Space fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'topic.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Topic fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchSpaces',
                'operation' => [
                    'id' => 'searchSpaces',
                    'method' => 'GET',
                    'path' => '/2/spaces/search',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'state',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'space.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'topic.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_spaces_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetSpacesById',
                'type' => 'read',
                'name' => 'Get Spaces By ID',
                'description' => 'Get space by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Space to be retrieved.',
                    ],
                    'space.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Space fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'topic.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Topic fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getSpacesById',
                'operation' => [
                    'id' => 'getSpacesById',
                    'method' => 'GET',
                    'path' => '/2/spaces/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'space.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'topic.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_spaces_buyers' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetSpacesBuyers',
                'type' => 'read',
                'name' => 'Get Spaces Buyers',
                'description' => 'Get Space ticket buyers',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Space to be retrieved.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getSpacesBuyers',
                'operation' => [
                    'id' => 'getSpacesBuyers',
                    'method' => 'GET',
                    'path' => '/2/spaces/{id}/buyers',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_spaces_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetSpacesPosts',
                'type' => 'read',
                'name' => 'Get Spaces Posts',
                'description' => 'Get Space Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Space to be retrieved.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of Posts to fetch from the provided space. If not provided, the value will default to the maximum of 100.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getSpacesPosts',
                'operation' => [
                    'id' => 'getSpacesPosts',
                    'method' => 'GET',
                    'path' => '/2/spaces/{id}/tweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'space.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Spaces',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'space.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_trends_by_woeid' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetTrendsByWoeid',
                'type' => 'read',
                'name' => 'Get Trends By WOEID',
                'description' => 'Get Trends by WOEID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'woeid' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The WOEID of the place to lookup a trend for.',
                    ],
                    'max_trends' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'trend.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Trend fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getTrendsByWoeid',
                'operation' => [
                    'id' => 'getTrendsByWoeid',
                    'method' => 'GET',
                    'path' => '/2/trends/by/woeid/{woeid}',
                    'parameters' => [
                        [
                            'name' => 'woeid',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_trends',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'trend.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Trends',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_by_ids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsByIds',
                'type' => 'read',
                'name' => 'Get Posts By Ids',
                'description' => 'Get Posts by IDs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A comma separated list of Post IDs. Up to 100 are allowed in a single request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsByIds',
                'operation' => [
                    'id' => 'getPostsByIds',
                    'method' => 'GET',
                    'path' => '/2/tweets',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreatePosts',
                'type' => 'write',
                'name' => 'Create Posts',
                'description' => 'Create or Edit Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'card_uri' => [
                                'type' => 'string',
                                'description' => 'Card Uri Parameter. This is mutually exclusive from Quote Tweet Id, Poll, Media, and Direct Message Deep Link.',
                                'required' => false,
                            ],
                            'community_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this Community.',
                                'required' => false,
                            ],
                            'direct_message_deep_link' => [
                                'type' => 'string',
                                'description' => 'Link to take the conversation from the public timeline to a private Direct Message.',
                                'required' => false,
                            ],
                            'edit_options' => [
                                'type' => 'object',
                                'description' => 'Options for editing an existing Post. When provided, this request will edit the specified Post instead of creating a new one.',
                                'properties' => [
                                    'previous_post_id' => [
                                        'type' => 'string',
                                        'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                            'for_super_followers_only' => [
                                'type' => 'boolean',
                                'description' => 'Exclusive Tweet for super followers.',
                                'required' => false,
                            ],
                            'geo' => [
                                'type' => 'object',
                                'description' => 'Place ID being attached to the Tweet for geo location.',
                                'properties' => [
                                    'place_id' => [
                                        'type' => 'string',
                                        'description' => '',
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                            'made_with_ai' => [
                                'type' => 'boolean',
                                'description' => 'Whether this Post contains AI-generated media. When true, the Post will be labeled accordingly.',
                                'required' => false,
                            ],
                            'media' => [
                                'type' => 'object',
                                'description' => 'Media information being attached to created Tweet. This is mutually exclusive from Quote Tweet Id, Poll, and Card URI.',
                                'properties' => [
                                    'call_to_actions' => [
                                        'type' => 'object',
                                        'description' => 'Call-to-action button rendered on the media entity. Exactly one variant should be set.',
                                        'properties' => [
                                            'app_install' => [
                                                'type' => 'object',
                                                'description' => 'App Install CTA. At least one store id should be provided.',
                                                'properties' => [
                                                    'app_store_id' => [
                                                        'type' => 'string',
                                                        'description' => 'Apple App Store iPhone app id.',
                                                        'required' => false,
                                                    ],
                                                    'ipad_app_store_id' => [
                                                        'type' => 'string',
                                                        'description' => 'Apple App Store iPad app id.',
                                                        'required' => false,
                                                    ],
                                                    'play_store_id' => [
                                                        'type' => 'string',
                                                        'description' => 'Google Play Store app id.',
                                                        'required' => false,
                                                    ],
                                                ],
                                                'required' => false,
                                            ],
                                            'visit_site' => [
                                                'type' => 'object',
                                                'description' => 'Visit Site CTA.',
                                                'properties' => [
                                                    'url' => [
                                                        'type' => 'string',
                                                        'description' => 'HTTPS URL the CTA links to.',
                                                        'required' => false,
                                                    ],
                                                ],
                                                'required' => false,
                                            ],
                                            'watch_now' => [
                                                'type' => 'object',
                                                'description' => 'Watch Now CTA.',
                                                'properties' => [
                                                    'url' => [
                                                        'type' => 'string',
                                                        'description' => 'HTTPS URL the CTA links to.',
                                                        'required' => false,
                                                    ],
                                                ],
                                                'required' => false,
                                            ],
                                        ],
                                        'required' => false,
                                    ],
                                    'description' => [
                                        'type' => 'string',
                                        'description' => 'Description for the media. Rendered on the Post card for video and Amplify content.',
                                        'required' => false,
                                    ],
                                    'embeddable' => [
                                        'type' => 'boolean',
                                        'description' => 'When true, the media\'s asset URLs do not expire and external syndicated playback is allowed.',
                                        'required' => false,
                                    ],
                                    'media_ids' => [
                                        'type' => 'array',
                                        'description' => 'A list of Media Ids to be attached to a created Tweet.',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'preview_media_id' => [
                                        'type' => 'string',
                                        'description' => 'The unique identifier of this Media.',
                                        'required' => false,
                                    ],
                                    'tagged_user_ids' => [
                                        'type' => 'array',
                                        'description' => 'A list of User Ids to be tagged in the media for created Tweet.',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'title' => [
                                        'type' => 'string',
                                        'description' => 'Title for the media. Rendered on the Post card for video and Amplify content.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                            'nullcast' => [
                                'type' => 'boolean',
                                'description' => 'Nullcasted (promoted-only) Posts do not appear in the public timeline and are not served to followers.',
                                'required' => false,
                            ],
                            'paid_partnership' => [
                                'type' => 'boolean',
                                'description' => 'Whether this Post is a paid partnership. When true, the Post will be labeled as a paid promotion.',
                                'required' => false,
                            ],
                            'poll' => [
                                'type' => 'object',
                                'description' => 'Poll options for a Tweet with a poll. This is mutually exclusive from Media, Quote Tweet Id, and Card URI.',
                                'properties' => [
                                    'duration_minutes' => [
                                        'type' => 'integer',
                                        'description' => 'Duration of the poll in minutes.',
                                        'required' => false,
                                    ],
                                    'options' => [
                                        'type' => 'array',
                                        'description' => '',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'reply_settings' => [
                                        'type' => 'string',
                                        'description' => 'Settings to indicate who can reply to the Tweet.',
                                        'enum' => [
                                            'following',
                                            'mentionedUsers',
                                            'subscribers',
                                            'verified',
                                        ],
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                            'quote_tweet_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => false,
                            ],
                            'reply' => [
                                'type' => 'object',
                                'description' => 'Tweet information of the Tweet being replied to.',
                                'properties' => [
                                    'auto_populate_reply_metadata' => [
                                        'type' => 'boolean',
                                        'description' => 'If set to true, reply metadata will be automatically populated.',
                                        'required' => false,
                                    ],
                                    'exclude_reply_user_ids' => [
                                        'type' => 'array',
                                        'description' => 'A list of User Ids to be excluded from the reply Tweet.',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'in_reply_to_tweet_id' => [
                                        'type' => 'string',
                                        'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => false,
                            ],
                            'reply_settings' => [
                                'type' => 'string',
                                'description' => 'Settings to indicate who can reply to the Tweet.',
                                'enum' => [
                                    'following',
                                    'mentionedUsers',
                                    'subscribers',
                                    'verified',
                                ],
                                'required' => false,
                            ],
                            'share_with_followers' => [
                                'type' => 'boolean',
                                'description' => 'Share community post with followers too.',
                                'required' => false,
                            ],
                            'text' => [
                                'type' => 'string',
                                'description' => 'The content of the Tweet.',
                                'required' => false,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createPosts',
                'operation' => [
                    'id' => 'createPosts',
                    'method' => 'POST',
                    'path' => '/2/tweets',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'tweet.write',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'tweet.write',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_analytics' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsAnalytics',
                'type' => 'read',
                'name' => 'Get Posts Analytics',
                'description' => 'Get Post analytics',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A comma separated list of Post IDs. Up to 100 are allowed in a single request.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the end of the time range.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The UTC timestamp representing the start of the time range.',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The granularity for the search counts results.',
                        'enum' => [
                            'hourly',
                            'daily',
                            'weekly',
                            'total',
                        ],
                    ],
                    'analytics.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Analytics fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsAnalytics',
                'operation' => [
                    'id' => 'getPostsAnalytics',
                    'method' => 'GET',
                    'path' => '/2/tweets/analytics',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'analytics.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_compliance' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsCompliance',
                'type' => 'read',
                'name' => 'Stream Posts Compliance',
                'description' => 'Stream Posts compliance data',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Post Compliance events will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Post Compliance events will be provided.',
                    ],
                ],
                'operation_id' => 'streamPostsCompliance',
                'operation' => [
                    'id' => 'streamPostsCompliance',
                    'method' => 'GET',
                    'path' => '/2/tweets/compliance/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_counts_all' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsCountsAll',
                'type' => 'read',
                'name' => 'Get Posts Counts All',
                'description' => 'Get count of all Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'One query/rule/filter for matching Posts. Refer to https://t.co/rulelength to identify the max query length.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The oldest UTC timestamp from which the Posts will be provided. Timestamp is in second granularity and is inclusive (i.e. 12:00:01 includes the first second of the minute).',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The newest, most recent UTC timestamp to which the Posts will be provided. Timestamp is in second granularity and is exclusive (i.e. 12:00:01 excludes the first second of the minute).',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID greater than (that is, more recent than) the specified ID.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID less than (that is, older than) the specified ID.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The granularity for the search counts results.',
                        'enum' => [
                            'minute',
                            'hour',
                            'day',
                        ],
                    ],
                    'search_count.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of SearchCount fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsCountsAll',
                'operation' => [
                    'id' => 'getPostsCountsAll',
                    'method' => 'GET',
                    'path' => '/2/tweets/counts/all',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'search_count.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_counts_recent' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsCountsRecent',
                'type' => 'read',
                'name' => 'Get Posts Counts Recent',
                'description' => 'Get count of recent Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'One query/rule/filter for matching Posts. Refer to https://t.co/rulelength to identify the max query length.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The oldest UTC timestamp (from most recent 7 days) from which the Posts will be provided. Timestamp is in second granularity and is inclusive (i.e. 12:00:01 includes the first second of the minute).',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The newest, most recent UTC timestamp to which the Posts will be provided. Timestamp is in second granularity and is exclusive (i.e. 12:00:01 excludes the first second of the minute).',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID greater than (that is, more recent than) the specified ID.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID less than (that is, older than) the specified ID.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'granularity' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The granularity for the search counts results.',
                        'enum' => [
                            'minute',
                            'hour',
                            'day',
                        ],
                    ],
                    'search_count.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of SearchCount fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsCountsRecent',
                'operation' => [
                    'id' => 'getPostsCountsRecent',
                    'method' => 'GET',
                    'path' => '/2/tweets/counts/recent',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'granularity',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'search_count.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_firehose' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsFirehose',
                'type' => 'read',
                'name' => 'Stream Posts Firehose',
                'description' => 'Stream all Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsFirehose',
                'operation' => [
                    'id' => 'streamPostsFirehose',
                    'method' => 'GET',
                    'path' => '/2/tweets/firehose/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_firehose_en' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsFirehoseEn',
                'type' => 'read',
                'name' => 'Stream Posts Firehose En',
                'description' => 'Stream English Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsFirehoseEn',
                'operation' => [
                    'id' => 'streamPostsFirehoseEn',
                    'method' => 'GET',
                    'path' => '/2/tweets/firehose/stream/lang/en',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_firehose_ja' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsFirehoseJa',
                'type' => 'read',
                'name' => 'Stream Posts Firehose Ja',
                'description' => 'Stream Japanese Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsFirehoseJa',
                'operation' => [
                    'id' => 'streamPostsFirehoseJa',
                    'method' => 'GET',
                    'path' => '/2/tweets/firehose/stream/lang/ja',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_firehose_ko' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsFirehoseKo',
                'type' => 'read',
                'name' => 'Stream Posts Firehose Ko',
                'description' => 'Stream Korean Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsFirehoseKo',
                'operation' => [
                    'id' => 'streamPostsFirehoseKo',
                    'method' => 'GET',
                    'path' => '/2/tweets/firehose/stream/lang/ko',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_firehose_pt' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsFirehosePt',
                'type' => 'read',
                'name' => 'Stream Posts Firehose Pt',
                'description' => 'Stream Portuguese Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsFirehosePt',
                'operation' => [
                    'id' => 'streamPostsFirehosePt',
                    'method' => 'GET',
                    'path' => '/2/tweets/firehose/stream/lang/pt',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_labels_compliance' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamLabelsCompliance',
                'type' => 'read',
                'name' => 'Stream Labels Compliance',
                'description' => 'Stream Post labels',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Post labels will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp from which the Post labels will be provided.',
                    ],
                ],
                'operation_id' => 'streamLabelsCompliance',
                'operation' => [
                    'id' => 'streamLabelsCompliance',
                    'method' => 'GET',
                    'path' => '/2/tweets/label/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_sample' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsSample',
                'type' => 'read',
                'name' => 'Stream Posts Sample',
                'description' => 'Stream sampled Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsSample',
                'operation' => [
                    'id' => 'streamPostsSample',
                    'method' => 'GET',
                    'path' => '/2/tweets/sample/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts_sample10' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPostsSample10',
                'type' => 'read',
                'name' => 'Stream Posts Sample10',
                'description' => 'Stream 10% sampled Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPostsSample10',
                'operation' => [
                    'id' => 'streamPostsSample10',
                    'method' => 'GET',
                    'path' => '/2/tweets/sample10/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_posts_all' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchPostsAll',
                'type' => 'read',
                'name' => 'Search Posts All',
                'description' => 'Search all Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'One query/rule/filter for matching Posts. Refer to https://t.co/rulelength to identify the max query length.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The oldest UTC timestamp from which the Posts will be provided. Timestamp is in second granularity and is inclusive (i.e. 12:00:01 includes the first second of the minute).',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The newest, most recent UTC timestamp to which the Posts will be provided. Timestamp is in second granularity and is exclusive (i.e. 12:00:01 excludes the first second of the minute).',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID greater than (that is, more recent than) the specified ID.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID less than (that is, older than) the specified ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of search results to be returned by a request.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'sort_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This order in which to return results.',
                        'enum' => [
                            'recency',
                            'relevancy',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchPostsAll',
                'operation' => [
                    'id' => 'searchPostsAll',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/all',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'sort_order',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_posts_recent' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchPostsRecent',
                'type' => 'read',
                'name' => 'Search Posts Recent',
                'description' => 'Search recent Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'One query/rule/filter for matching Posts. Refer to https://t.co/rulelength to identify the max query length.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The oldest UTC timestamp from which the Posts will be provided. Timestamp is in second granularity and is inclusive (i.e. 12:00:01 includes the first second of the minute).',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The newest, most recent UTC timestamp to which the Posts will be provided. Timestamp is in second granularity and is exclusive (i.e. 12:00:01 excludes the first second of the minute).',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID greater than (that is, more recent than) the specified ID.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Returns results with a Post ID less than (that is, older than) the specified ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of search results to be returned by a request.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'sort_order' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This order in which to return results.',
                        'enum' => [
                            'recency',
                            'relevancy',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchPostsRecent',
                'operation' => [
                    'id' => 'searchPostsRecent',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/recent',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'sort_order',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamPosts',
                'type' => 'read',
                'name' => 'Stream Posts',
                'description' => 'Stream filtered Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Posts will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'streamPosts',
                'operation' => [
                    'id' => 'streamPosts',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_rules' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetRules',
                'type' => 'read',
                'name' => 'Get Rules',
                'description' => 'Get stream rules',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma-separated list of Rule IDs.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This value is populated by passing the \'next_token\' returned in a request to paginate through results.',
                    ],
                ],
                'operation_id' => 'getRules',
                'operation' => [
                    'id' => 'getRules',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/stream/rules',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_update_rules' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUpdateRules',
                'type' => 'write',
                'name' => 'Update Rules',
                'description' => 'Update stream rules',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'dry_run' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Dry Run can be used with both the add and delete action, with the expected result given, but without actually taking any action in the system (meaning the end state will always be as it was when the request was submitted). This is particularly useful to validate rule changes.',
                    ],
                    'delete_all' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Delete All can be used to delete all of the rules associated this client app, it should be specified with no other parameters. Once deleted, rules cannot be recovered.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'add' => [
                                'type' => 'array',
                                'description' => '',
                                'items' => [
                                    'type' => 'object',
                                ],
                                'required' => false,
                            ],
                            'delete' => [
                                'type' => 'object',
                                'description' => 'IDs and values of all deleted user-specified stream filtering rules.',
                                'properties' => [
                                    'ids' => [
                                        'type' => 'array',
                                        'description' => 'IDs of all deleted user-specified stream filtering rules.',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                    'values' => [
                                        'type' => 'array',
                                        'description' => 'Values of all deleted user-specified stream filtering rules.',
                                        'items' => [
                                            'type' => 'string',
                                        ],
                                        'required' => false,
                                    ],
                                ],
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'updateRules',
                'operation' => [
                    'id' => 'updateRules',
                    'method' => 'POST',
                    'path' => '/2/tweets/search/stream/rules',
                    'parameters' => [
                        [
                            'name' => 'dry_run',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'delete_all',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_rule_counts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetRuleCounts',
                'type' => 'read',
                'name' => 'Get Rule Counts',
                'description' => 'Get stream rule counts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'rules_count.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of RulesCount fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getRuleCounts',
                'operation' => [
                    'id' => 'getRuleCounts',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/stream/rules/counts',
                    'parameters' => [
                        [
                            'name' => 'rules_count.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Stream',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_webhooks_stream_links' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetWebhooksStreamLinks',
                'type' => 'read',
                'name' => 'Get Webhooks Stream Links',
                'description' => 'Get stream links',
                'icon' => 'simple-icons:x',
                'parameters' => [
                ],
                'operation_id' => 'getWebhooksStreamLinks',
                'operation' => [
                    'id' => 'getWebhooksStreamLinks',
                    'method' => 'GET',
                    'path' => '/2/tweets/search/webhooks',
                    'parameters' => [
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                        'Stream',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_webhooks_stream_link' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteWebhooksStreamLink',
                'type' => 'write',
                'name' => 'Delete Webhooks Stream Link',
                'description' => 'Delete stream link',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to link to your FilteredStream ruleset.',
                    ],
                ],
                'operation_id' => 'deleteWebhooksStreamLink',
                'operation' => [
                    'id' => 'deleteWebhooksStreamLink',
                    'method' => 'DELETE',
                    'path' => '/2/tweets/search/webhooks/{webhook_id}',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                        'Stream',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_webhooks_stream_link' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateWebhooksStreamLink',
                'type' => 'write',
                'name' => 'Create Webhooks Stream Link',
                'description' => 'Create stream link',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The webhook ID to link to your FilteredStream ruleset.',
                    ],
                    'tweet.fields' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                    ],
                    'expansions' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                    ],
                    'media.fields' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                    ],
                    'poll.fields' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                    ],
                    'user.fields' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                    ],
                    'place.fields' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                    ],
                ],
                'operation_id' => 'createWebhooksStreamLink',
                'operation' => [
                    'id' => 'createWebhooksStreamLink',
                    'method' => 'POST',
                    'path' => '/2/tweets/search/webhooks/{webhook_id}',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                        'Stream',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeletePosts',
                'type' => 'write',
                'name' => 'Delete Posts',
                'description' => 'Delete Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Post to be deleted.',
                    ],
                ],
                'operation_id' => 'deletePosts',
                'operation' => [
                    'id' => 'deletePosts',
                    'method' => 'DELETE',
                    'path' => '/2/tweets/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'tweet.write',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'tweet.write',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsById',
                'type' => 'read',
                'name' => 'Get Posts By ID',
                'description' => 'Get Post by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Post ID.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsById',
                'operation' => [
                    'id' => 'getPostsById',
                    'method' => 'GET',
                    'path' => '/2/tweets/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_liking_users' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsLikingUsers',
                'type' => 'read',
                'name' => 'Get Posts Liking Users',
                'description' => 'Get Liking Users',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Post ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsLikingUsers',
                'operation' => [
                    'id' => 'getPostsLikingUsers',
                    'method' => 'GET',
                    'path' => '/2/tweets/{id}/liking_users',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'like.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'like.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_quoted_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsQuotedPosts',
                'type' => 'read',
                'name' => 'Get Posts Quoted Posts',
                'description' => 'Get Quoted Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Post ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results to be returned.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'exclude' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of entities to exclude (e.g. \'replies\' or \'retweets\').',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsQuotedPosts',
                'operation' => [
                    'id' => 'getPostsQuotedPosts',
                    'method' => 'GET',
                    'path' => '/2/tweets/{id}/quote_tweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'exclude',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_reposted_by' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsRepostedBy',
                'type' => 'read',
                'name' => 'Get Posts Reposted By',
                'description' => 'Get Reposted by',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Post ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsRepostedBy',
                'operation' => [
                    'id' => 'getPostsRepostedBy',
                    'method' => 'GET',
                    'path' => '/2/tweets/{id}/retweeted_by',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_posts_reposts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetPostsReposts',
                'type' => 'read',
                'name' => 'Get Posts Reposts',
                'description' => 'Get Reposts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A single Post ID.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getPostsReposts',
                'operation' => [
                    'id' => 'getPostsReposts',
                    'method' => 'GET',
                    'path' => '/2/tweets/{id}/retweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_hide_posts_reply' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XHidePostsReply',
                'type' => 'write',
                'name' => 'Hide Posts Reply',
                'description' => 'Hide reply',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the reply that you want to hide or unhide.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'hidden' => [
                                'type' => 'boolean',
                                'description' => '',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'hidePostsReply',
                'operation' => [
                    'id' => 'hidePostsReply',
                    'method' => 'PUT',
                    'path' => '/2/tweets/{tweet_id}/hidden',
                    'parameters' => [
                        [
                            'name' => 'tweet_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.moderate.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.moderate.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_usage' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsage',
                'type' => 'read',
                'name' => 'Get Usage',
                'description' => 'Get usage',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'days' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of days for which you need usage for.',
                    ],
                    'usage.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Usage fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsage',
                'operation' => [
                    'id' => 'getUsage',
                    'method' => 'GET',
                    'path' => '/2/usage/tweets',
                    'parameters' => [
                        [
                            'name' => 'days',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'usage.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Usage',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_by_ids' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersByIds',
                'type' => 'read',
                'name' => 'Get Users By Ids',
                'description' => 'Get Users by IDs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A list of User IDs, comma-separated. You can specify up to 100 IDs.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersByIds',
                'operation' => [
                    'id' => 'getUsersByIds',
                    'method' => 'GET',
                    'path' => '/2/users',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_by_usernames' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersByUsernames',
                'type' => 'read',
                'name' => 'Get Users By Usernames',
                'description' => 'Get Users by usernames',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'usernames' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A list of usernames, comma-separated.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersByUsernames',
                'operation' => [
                    'id' => 'getUsersByUsernames',
                    'method' => 'GET',
                    'path' => '/2/users/by',
                    'parameters' => [
                        [
                            'name' => 'usernames',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_by_username' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersByUsername',
                'type' => 'read',
                'name' => 'Get Users By Username',
                'description' => 'Get User by username',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'username' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A username.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersByUsername',
                'operation' => [
                    'id' => 'getUsersByUsername',
                    'method' => 'GET',
                    'path' => '/2/users/by/username/{username}',
                    'parameters' => [
                        [
                            'name' => 'username',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_stream_users_compliance' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XStreamUsersCompliance',
                'type' => 'read',
                'name' => 'Stream Users Compliance',
                'description' => 'Stream Users compliance data',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'backfill_minutes' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of minutes of backfill requested.',
                    ],
                    'partition' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The partition number.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the User Compliance events will be provided.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp from which the User Compliance events will be provided.',
                    ],
                ],
                'operation_id' => 'streamUsersCompliance',
                'operation' => [
                    'id' => 'streamUsersCompliance',
                    'method' => 'GET',
                    'path' => '/2/users/compliance/stream',
                    'parameters' => [
                        [
                            'name' => 'backfill_minutes',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'partition',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'stream',
                    'tags' => [
                        'Stream',
                        'Compliance',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'paid_or_elevated_access',
                'runtime_mode' => 'stream',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_me' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersMe',
                'type' => 'read',
                'name' => 'Get Users Me',
                'description' => 'Get my User',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersMe',
                'operation' => [
                    'id' => 'getUsersMe',
                    'method' => 'GET',
                    'path' => '/2/users/me',
                    'parameters' => [
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_trends_personalized_trends' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetTrendsPersonalizedTrends',
                'type' => 'read',
                'name' => 'Get Trends Personalized Trends',
                'description' => 'Get personalized Trends',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'personalized_trend.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of PersonalizedTrend fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getTrendsPersonalizedTrends',
                'operation' => [
                    'id' => 'getTrendsPersonalizedTrends',
                    'method' => 'GET',
                    'path' => '/2/users/personalized_trends',
                    'parameters' => [
                        [
                            'name' => 'personalized_trend.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Trends',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_public_keys' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersPublicKeys',
                'type' => 'read',
                'name' => 'Get Users Public Keys',
                'description' => 'Get public keys for multiple users',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'ids' => [
                        'type' => 'array',
                        'required' => true,
                        'description' => 'A list of User IDs, comma-separated. You can specify up to 100 IDs.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'public_key.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of PublicKey fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersPublicKeys',
                'operation' => [
                    'id' => 'getUsersPublicKeys',
                    'method' => 'GET',
                    'path' => '/2/users/public_keys',
                    'parameters' => [
                        [
                            'name' => 'ids',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'public_key.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_reposts_of_me' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersRepostsOfMe',
                'type' => 'read',
                'name' => 'Get Users Reposts Of Me',
                'description' => 'Get Reposts of me',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersRepostsOfMe',
                'operation' => [
                    'id' => 'getUsersRepostsOfMe',
                    'method' => 'GET',
                    'path' => '/2/users/reposts_of_me',
                    'parameters' => [
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'timeline.read',
                        'tweet.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'timeline.read',
                    'tweet.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_search_users' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XSearchUsers',
                'type' => 'read',
                'name' => 'Search Users',
                'description' => 'Search Users',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'TThe the query string by which to query for users.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'next_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results. The value used with the parameter is pulled directly from the response provided by the API, and should not be modified.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'searchUsers',
                'operation' => [
                    'id' => 'searchUsers',
                    'method' => 'GET',
                    'path' => '/2/users/search',
                    'parameters' => [
                        [
                            'name' => 'query',
                            'in' => 'query',
                            'required' => true,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'next_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => true,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_by_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersById',
                'type' => 'read',
                'name' => 'Get Users By ID',
                'description' => 'Get User by ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersById',
                'operation' => [
                    'id' => 'getUsersById',
                    'method' => 'GET',
                    'path' => '/2/users/{id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_affiliates' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersAffiliates',
                'type' => 'read',
                'name' => 'Get Users Affiliates',
                'description' => 'Get affiliates',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersAffiliates',
                'operation' => [
                    'id' => 'getUsersAffiliates',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/affiliates',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_blocking' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersBlocking',
                'type' => 'read',
                'name' => 'Get Users Blocking',
                'description' => 'Get blocking',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersBlocking',
                'operation' => [
                    'id' => 'getUsersBlocking',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/blocking',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'block.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'block.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_bookmarks' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersBookmarks',
                'type' => 'read',
                'name' => 'Get Users Bookmarks',
                'description' => 'Get Bookmarks',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersBookmarks',
                'operation' => [
                    'id' => 'getUsersBookmarks',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/bookmarks',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'bookmark.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Bookmarks',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'bookmark.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_users_bookmark' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateUsersBookmark',
                'type' => 'write',
                'name' => 'Create Users Bookmark',
                'description' => 'Create Bookmark',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to add bookmarks.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'tweet_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createUsersBookmark',
                'operation' => [
                    'id' => 'createUsersBookmark',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/bookmarks',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'bookmark.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Bookmarks',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'bookmark.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_bookmark_folders' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersBookmarkFolders',
                'type' => 'read',
                'name' => 'Get Users Bookmark Folders',
                'description' => 'Get Bookmark folders',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                ],
                'operation_id' => 'getUsersBookmarkFolders',
                'operation' => [
                    'id' => 'getUsersBookmarkFolders',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/bookmarks/folders',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'bookmark.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Bookmarks',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'bookmark.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_bookmarks_by_folder_id' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersBookmarksByFolderId',
                'type' => 'read',
                'name' => 'Get Users Bookmarks By Folder ID',
                'description' => 'Get Bookmarks by folder ID',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'folder_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Bookmark Folder that the authenticated User is trying to fetch Posts for.',
                    ],
                ],
                'operation_id' => 'getUsersBookmarksByFolderId',
                'operation' => [
                    'id' => 'getUsersBookmarksByFolderId',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/bookmarks/folders/{folder_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'folder_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'bookmark.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Bookmarks',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'bookmark.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_users_bookmark' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteUsersBookmark',
                'type' => 'write',
                'name' => 'Delete Users Bookmark',
                'description' => 'Delete Bookmark',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User whose bookmark is to be removed.',
                    ],
                    'tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Post that the source User is removing from bookmarks.',
                    ],
                ],
                'operation_id' => 'deleteUsersBookmark',
                'operation' => [
                    'id' => 'deleteUsersBookmark',
                    'method' => 'DELETE',
                    'path' => '/2/users/{id}/bookmarks/{tweet_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                    ],
                    'required_scopes' => [
                        'bookmark.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Bookmarks',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                ],
                'required_scopes' => [
                    'bookmark.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_block_users_dms' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XBlockUsersDms',
                'type' => 'write',
                'name' => 'Block Users Dms',
                'description' => 'Block DMs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the target User that the authenticated user requesting to block dms for.',
                    ],
                ],
                'operation_id' => 'blockUsersDms',
                'operation' => [
                    'id' => 'blockUsersDms',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/dm/block',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unblock_users_dms' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnblockUsersDms',
                'type' => 'write',
                'name' => 'Unblock Users Dms',
                'description' => 'Unblock DMs',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the target User that the authenticated user requesting to unblock dms for.',
                    ],
                ],
                'operation_id' => 'unblockUsersDms',
                'operation' => [
                    'id' => 'unblockUsersDms',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/dm/unblock',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_followed_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersFollowedLists',
                'type' => 'read',
                'name' => 'Get Users Followed Lists',
                'description' => 'Get followed Lists',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'list.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of List fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersFollowedLists',
                'operation' => [
                    'id' => 'getUsersFollowedLists',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/followed_lists',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_follow_list' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XFollowList',
                'type' => 'write',
                'name' => 'Follow List',
                'description' => 'Follow List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that will follow the List.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'list_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this List.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'followList',
                'operation' => [
                    'id' => 'followList',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/followed_lists',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unfollow_list' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnfollowList',
                'type' => 'write',
                'name' => 'Unfollow List',
                'description' => 'Unfollow List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that will unfollow the List.',
                    ],
                    'list_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List to unfollow.',
                    ],
                ],
                'operation_id' => 'unfollowList',
                'operation' => [
                    'id' => 'unfollowList',
                    'method' => 'DELETE',
                    'path' => '/2/users/{id}/followed_lists/{list_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_followers' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersFollowers',
                'type' => 'read',
                'name' => 'Get Users Followers',
                'description' => 'Get followers',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersFollowers',
                'operation' => [
                    'id' => 'getUsersFollowers',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/followers',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'follows.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'follows.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_following' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersFollowing',
                'type' => 'read',
                'name' => 'Get Users Following',
                'description' => 'Get following',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersFollowing',
                'operation' => [
                    'id' => 'getUsersFollowing',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/following',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'follows.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'follows.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_follow_user' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XFollowUser',
                'type' => 'write',
                'name' => 'Follow User',
                'description' => 'Follow User',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to follow the target User.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'target_user_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this User. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'followUser',
                'operation' => [
                    'id' => 'followUser',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/following',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'follows.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'follows.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_liked_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersLikedPosts',
                'type' => 'read',
                'name' => 'Get Users Liked Posts',
                'description' => 'Get liked Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersLikedPosts',
                'operation' => [
                    'id' => 'getUsersLikedPosts',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/liked_tweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'like.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'like.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_like_post' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XLikePost',
                'type' => 'write',
                'name' => 'Like Post',
                'description' => 'Like Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to like the Post.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'tweet_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'likePost',
                'operation' => [
                    'id' => 'likePost',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/likes',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'like.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'like.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unlike_post' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnlikePost',
                'type' => 'write',
                'name' => 'Unlike Post',
                'description' => 'Unlike Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to unlike the Post.',
                    ],
                    'tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Post that the User is requesting to unlike.',
                    ],
                ],
                'operation_id' => 'unlikePost',
                'operation' => [
                    'id' => 'unlikePost',
                    'method' => 'DELETE',
                    'path' => '/2/users/{id}/likes/{tweet_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'like.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'like.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_list_memberships' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersListMemberships',
                'type' => 'read',
                'name' => 'Get Users List Memberships',
                'description' => 'Get List memberships',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'list.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of List fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersListMemberships',
                'operation' => [
                    'id' => 'getUsersListMemberships',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/list_memberships',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_mentions' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersMentions',
                'type' => 'read',
                'name' => 'Get Users Mentions',
                'description' => 'Get mentions',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The minimum Post ID to be included in the result set. This parameter takes precedence over start_time if both are specified.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The maximum Post ID to be included in the result set. This parameter takes precedence over end_time if both are specified.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Posts will be provided. The since_id parameter takes precedence if it is also specified.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided. The until_id parameter takes precedence if it is also specified.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersMentions',
                'operation' => [
                    'id' => 'getUsersMentions',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/mentions',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_muting' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersMuting',
                'type' => 'read',
                'name' => 'Get Users Muting',
                'description' => 'Get muting',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersMuting',
                'operation' => [
                    'id' => 'getUsersMuting',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/muting',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'mute.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'mute.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_mute_user' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XMuteUser',
                'type' => 'write',
                'name' => 'Mute User',
                'description' => 'Mute User',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to mute the target User.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'target_user_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this User. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'muteUser',
                'operation' => [
                    'id' => 'muteUser',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/muting',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'mute.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'mute.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_owned_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersOwnedLists',
                'type' => 'read',
                'name' => 'Get Users Owned Lists',
                'description' => 'Get owned Lists',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get a specified \'page\' of results.',
                    ],
                    'list.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of List fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersOwnedLists',
                'operation' => [
                    'id' => 'getUsersOwnedLists',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/owned_lists',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_pinned_lists' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersPinnedLists',
                'type' => 'read',
                'name' => 'Get Users Pinned Lists',
                'description' => 'Get pinned Lists',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'list.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of List fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersPinnedLists',
                'operation' => [
                    'id' => 'getUsersPinnedLists',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/pinned_lists',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_pin_list' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XPinList',
                'type' => 'write',
                'name' => 'Pin List',
                'description' => 'Pin List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that will pin the List.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'list_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this List.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'pinList',
                'operation' => [
                    'id' => 'pinList',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/pinned_lists',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unpin_list' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnpinList',
                'type' => 'write',
                'name' => 'Unpin List',
                'description' => 'Unpin List',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User for whom to return results.',
                    ],
                    'list_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the List to unpin.',
                    ],
                ],
                'operation_id' => 'unpinList',
                'operation' => [
                    'id' => 'unpinList',
                    'method' => 'DELETE',
                    'path' => '/2/users/{id}/pinned_lists/{list_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'list_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'list.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Lists',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'list.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_public_key' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersPublicKey',
                'type' => 'read',
                'name' => 'Get Users Public Key',
                'description' => 'Get user public keys',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'public_key.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of PublicKey fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersPublicKey',
                'operation' => [
                    'id' => 'getUsersPublicKey',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/public_keys',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'public_key.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.read',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.read',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_add_user_public_key' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XAddUserPublicKey',
                'type' => 'write',
                'name' => 'Add User Public Key',
                'description' => 'Add public key',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the requesting user.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'generate_version' => [
                                'type' => 'boolean',
                                'description' => 'When true, the server generates a new version.',
                                'required' => false,
                            ],
                            'public_key' => [
                                'type' => 'object',
                                'description' => 'Public key registration payload.',
                                'properties' => [
                                    'identity_public_key_signature' => [
                                        'type' => 'string',
                                        'description' => 'Signature over the identity public key.',
                                        'required' => false,
                                    ],
                                    'public_key' => [
                                        'type' => 'string',
                                        'description' => 'Identity public key (base64 encoded).',
                                        'required' => false,
                                    ],
                                    'public_key_fingerprint' => [
                                        'type' => 'string',
                                        'description' => 'Fingerprint of the identity public key.',
                                        'required' => false,
                                    ],
                                    'registration_method' => [
                                        'type' => 'string',
                                        'description' => 'Registration method for the public key.',
                                        'required' => false,
                                    ],
                                    'signing_public_key' => [
                                        'type' => 'string',
                                        'description' => 'Signing public key (base64 encoded).',
                                        'required' => false,
                                    ],
                                    'signing_public_key_signature' => [
                                        'type' => 'string',
                                        'description' => 'Signature over the signing public key.',
                                        'required' => false,
                                    ],
                                ],
                                'required' => true,
                            ],
                            'version' => [
                                'type' => 'string',
                                'description' => 'Public key version.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'addUserPublicKey',
                'operation' => [
                    'id' => 'addUserPublicKey',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/public_keys',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'dm.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Chat',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'dm.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_repost_post' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XRepostPost',
                'type' => 'write',
                'name' => 'Repost Post',
                'description' => 'Repost Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to repost the Post.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'tweet_id' => [
                                'type' => 'string',
                                'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'repostPost',
                'operation' => [
                    'id' => 'repostPost',
                    'method' => 'POST',
                    'path' => '/2/users/{id}/retweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'tweet.write',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'tweet.write',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unrepost_post' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnrepostPost',
                'type' => 'write',
                'name' => 'Unrepost Post',
                'description' => 'Unrepost Post',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to repost the Post.',
                    ],
                    'source_tweet_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Post that the User is requesting to unretweet.',
                    ],
                ],
                'operation_id' => 'unrepostPost',
                'operation' => [
                    'id' => 'unrepostPost',
                    'method' => 'DELETE',
                    'path' => '/2/users/{id}/retweets/{source_tweet_id}',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'source_tweet_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'tweet.write',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'tweet.write',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_timeline' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersTimeline',
                'type' => 'read',
                'name' => 'Get Users Timeline',
                'description' => 'Get Timeline',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User to list Reverse Chronological Timeline Posts of.',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The minimum Post ID to be included in the result set. This parameter takes precedence over start_time if both are specified.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The maximum Post ID to be included in the result set. This parameter takes precedence over end_time if both are specified.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'exclude' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of entities to exclude (e.g. \'replies\' or \'retweets\').',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Posts will be provided. The since_id parameter takes precedence if it is also specified.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided. The until_id parameter takes precedence if it is also specified.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersTimeline',
                'operation' => [
                    'id' => 'getUsersTimeline',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/timelines/reverse_chronological',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'exclude',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_users_posts' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetUsersPosts',
                'type' => 'read',
                'name' => 'Get Users Posts',
                'description' => 'Get Posts',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User to lookup.',
                    ],
                    'since_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The minimum Post ID to be included in the result set. This parameter takes precedence over start_time if both are specified.',
                    ],
                    'until_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The maximum Post ID to be included in the result set. This parameter takes precedence over end_time if both are specified.',
                    ],
                    'max_results' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results.',
                    ],
                    'pagination_token' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'This parameter is used to get the next \'page\' of results.',
                    ],
                    'exclude' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'The set of entities to exclude (e.g. \'replies\' or \'retweets\').',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'start_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Posts will be provided. The since_id parameter takes precedence if it is also specified.',
                    ],
                    'end_time' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided. The until_id parameter takes precedence if it is also specified.',
                    ],
                    'tweet.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Tweet fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'expansions' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of fields to expand.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'media.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Media fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'poll.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Poll fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'user.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of User fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                    'place.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of Place fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getUsersPosts',
                'operation' => [
                    'id' => 'getUsersPosts',
                    'method' => 'GET',
                    'path' => '/2/users/{id}/tweets',
                    'parameters' => [
                        [
                            'name' => 'id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'since_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'until_id',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'max_results',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'pagination_token',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'exclude',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'start_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'end_time',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => null,
                        ],
                        [
                            'name' => 'tweet.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'expansions',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'media.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'poll.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'user.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                        [
                            'name' => 'place.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                        'Tweets',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unfollow_user' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnfollowUser',
                'type' => 'write',
                'name' => 'Unfollow User',
                'description' => 'Unfollow User',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'source_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to unfollow the target User.',
                    ],
                    'target_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User that the source User is requesting to unfollow.',
                    ],
                ],
                'operation_id' => 'unfollowUser',
                'operation' => [
                    'id' => 'unfollowUser',
                    'method' => 'DELETE',
                    'path' => '/2/users/{source_user_id}/following/{target_user_id}',
                    'parameters' => [
                        [
                            'name' => 'source_user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'target_user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'follows.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'follows.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_unmute_user' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XUnmuteUser',
                'type' => 'write',
                'name' => 'Unmute User',
                'description' => 'Unmute User',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'source_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the authenticated source User that is requesting to unmute the target User.',
                    ],
                    'target_user_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the User that the source User is requesting to unmute.',
                    ],
                ],
                'operation_id' => 'unmuteUser',
                'operation' => [
                    'id' => 'unmuteUser',
                    'method' => 'DELETE',
                    'path' => '/2/users/{source_user_id}/muting/{target_user_id}',
                    'parameters' => [
                        [
                            'name' => 'source_user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                        [
                            'name' => 'target_user_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'oauth2_pkce',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                        'mute.write',
                        'tweet.read',
                        'users.read',
                    ],
                    'runtime_mode' => 'request_response',
                    'tags' => [
                        'Users',
                    ],
                ],
                'auth_modes' => [
                    'oauth2_pkce',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                    'mute.write',
                    'tweet.read',
                    'users.read',
                ],
                'required_access_tier' => null,
                'runtime_mode' => 'request_response',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_get_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XGetWebhooks',
                'type' => 'read',
                'name' => 'Get Webhooks',
                'description' => 'Get webhook',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_config.fields' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A comma separated list of WebhookConfig fields to display.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
                'operation_id' => 'getWebhooks',
                'operation' => [
                    'id' => 'getWebhooks',
                    'method' => 'GET',
                    'path' => '/2/webhooks',
                    'parameters' => [
                        [
                            'name' => 'webhook_config.fields',
                            'in' => 'query',
                            'required' => false,
                            'style' => 'form',
                            'explode' => false,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateWebhooks',
                'type' => 'write',
                'name' => 'Create Webhooks',
                'description' => 'Create webhook',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'url' => [
                                'type' => 'string',
                                'description' => '',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createWebhooks',
                'operation' => [
                    'id' => 'createWebhooks',
                    'method' => 'POST',
                    'path' => '/2/webhooks',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_create_webhook_replay_job' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XCreateWebhookReplayJob',
                'type' => 'write',
                'name' => 'Create Webhook Replay Job',
                'description' => 'Create replay job for webhook',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
                        'properties' => [
                            'from_date' => [
                                'type' => 'string',
                                'description' => 'The oldest (starting) UTC timestamp (inclusive) from which events will be provided, in yyyymmddhhmm format.',
                                'required' => true,
                            ],
                            'to_date' => [
                                'type' => 'string',
                                'description' => 'The oldest (starting) UTC timestamp (inclusive) from which events will be provided, in yyyymmddhhmm format.',
                                'required' => true,
                            ],
                            'webhook_id' => [
                                'type' => 'string',
                                'description' => 'The unique identifier of this webhook config.',
                                'required' => true,
                            ],
                        ],
                    ],
                ],
                'operation_id' => 'createWebhookReplayJob',
                'operation' => [
                    'id' => 'createWebhookReplayJob',
                    'method' => 'POST',
                    'path' => '/2/webhooks/replay',
                    'parameters' => [
                    ],
                    'has_body' => true,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_delete_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XDeleteWebhooks',
                'type' => 'write',
                'name' => 'Delete Webhooks',
                'description' => 'Delete webhook',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the webhook to delete.',
                    ],
                ],
                'operation_id' => 'deleteWebhooks',
                'operation' => [
                    'id' => 'deleteWebhooks',
                    'method' => 'DELETE',
                    'path' => '/2/webhooks/{webhook_id}',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => true,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
            'x_validate_webhooks' => [
                'class' => 'OpenCompany\\Integrations\\X\\Tools\\XValidateWebhooks',
                'type' => 'write',
                'name' => 'Validate Webhooks',
                'description' => 'Validate webhook',
                'icon' => 'simple-icons:x',
                'parameters' => [
                    'webhook_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the webhook to check.',
                    ],
                ],
                'operation_id' => 'validateWebhooks',
                'operation' => [
                    'id' => 'validateWebhooks',
                    'method' => 'PUT',
                    'path' => '/2/webhooks/{webhook_id}',
                    'parameters' => [
                        [
                            'name' => 'webhook_id',
                            'in' => 'path',
                            'required' => true,
                            'style' => 'simple',
                            'explode' => null,
                        ],
                    ],
                    'has_body' => false,
                    'body_mode' => 'json',
                    'auth_modes' => [
                        'bearer_token',
                        'oauth1a_user_context',
                    ],
                    'required_scopes' => [
                    ],
                    'runtime_mode' => 'webhook_subscription',
                    'tags' => [
                        'Webhooks',
                    ],
                ],
                'auth_modes' => [
                    'bearer_token',
                    'oauth1a_user_context',
                ],
                'required_scopes' => [
                ],
                'required_access_tier' => 'enterprise_or_approved_access',
                'runtime_mode' => 'webhook_subscription',
                'destructive' => false,
                'billing_sensitive' => false,
                'docs_url' => 'https://docs.x.com/x-api',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__) . '/script-docs/x.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'bearer_token', 'type' => 'secret', 'label' => 'Bearer Token', 'required' => false, 'hint' => 'App-only token for public read endpoints.'],
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => false, 'hint' => 'OAuth 2.0 user-context token or OAuth 1.0a user token.'],
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'OAuth 1.0a API Key', 'required' => false],
            ['key' => 'api_secret', 'type' => 'secret', 'label' => 'OAuth 1.0a API Secret', 'required' => false],
            ['key' => 'access_token_secret', 'type' => 'secret', 'label' => 'OAuth 1.0a Access Token Secret', 'required' => false],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.x.com/2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a generated X tool with optional multi-account credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name
     * @param  array<string, mixed>  $context  Runtime context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the service for the default or named account.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): XService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            $bearerToken = (string) $creds->get('x', 'bearer_token', '', $account);
            $accessToken = (string) $creds->get('x', 'access_token', '', $account);
            $apiKey = (string) $creds->get('x', 'api_key', '', $account);
            $apiSecret = (string) $creds->get('x', 'api_secret', '', $account);
            $accessTokenSecret = (string) $creds->get('x', 'access_token_secret', '', $account);
            $baseUrl = (string) $creds->get('x', 'base_url', '', $account);

            if ($bearerToken === '') {
                $bearerToken = (string) $creds->get('twitter', 'bearer_token', '', $account);
            }

            if ($bearerToken === '') {
                $bearerToken = (string) $creds->get('twitter', 'access_token', '', $account);
            }

            if ($accessToken === '') {
                $accessToken = (string) $creds->get('twitter', 'oauth_access_token', '', $account);
            }

            if ($apiKey === '') {
                $apiKey = (string) $creds->get('twitter', 'api_key', '', $account);
            }

            if ($apiSecret === '') {
                $apiSecret = (string) $creds->get('twitter', 'api_secret', '', $account);
            }

            if ($accessTokenSecret === '') {
                $accessTokenSecret = (string) $creds->get('twitter', 'access_token_secret', '', $account);
            }

            if ($baseUrl === '') {
                $baseUrl = (string) $creds->get('twitter', 'url', 'https://api.x.com/2', $account);
            }

            return new XService(
                bearerToken: $bearerToken,
                accessToken: $accessToken,
                apiKey: $apiKey,
                apiSecret: $apiSecret,
                accessTokenSecret: $accessTokenSecret,
                baseUrl: $baseUrl,
            );
        }

        return app(XService::class);
    }
}
