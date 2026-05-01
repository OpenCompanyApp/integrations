<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Upload media
 */
class XMediaUpload extends XGeneratedTool
{
    protected const SLUG = 'x_media_upload';

    protected const DESCRIPTION = 'Upload media';

    protected const PARAMETERS = [
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
    ];

    protected const OPERATION = [
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
    ];
}
