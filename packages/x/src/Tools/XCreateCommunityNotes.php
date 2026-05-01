<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create a Community Note
 */
class XCreateCommunityNotes extends XGeneratedTool
{
    protected const SLUG = 'x_create_community_notes';

    protected const DESCRIPTION = 'Create a Community Note';

    protected const PARAMETERS = [
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
    ];

    protected const OPERATION = [
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
    ];
}
