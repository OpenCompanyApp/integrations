<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create X activity subscription
 */
class XCreateActivitySubscription extends XGeneratedTool
{
    protected const SLUG = 'x_create_activity_subscription';

    protected const DESCRIPTION = 'Create X activity subscription';

    protected const PARAMETERS = [
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
    ];

    protected const OPERATION = [
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
    ];
}
