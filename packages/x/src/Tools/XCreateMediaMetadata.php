<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create Media metadata
 */
class XCreateMediaMetadata extends XGeneratedTool
{
    protected const SLUG = 'x_create_media_metadata';

    protected const DESCRIPTION = 'Create Media metadata';

    protected const PARAMETERS = [
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
                            'type' => 'string',
                            'description' => '',
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
    ];

    protected const OPERATION = [
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
    ];
}
