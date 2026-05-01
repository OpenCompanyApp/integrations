<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create or Edit Post
 */
class XCreatePosts extends XGeneratedTool
{
    protected const SLUG = 'x_create_posts';

    protected const DESCRIPTION = 'Create or Edit Post';

    protected const PARAMETERS = [
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
    ];

    protected const OPERATION = [
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
    ];
}
