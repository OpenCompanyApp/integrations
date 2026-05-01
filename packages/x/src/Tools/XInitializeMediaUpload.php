<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Initialize media upload
 */
class XInitializeMediaUpload extends XGeneratedTool
{
    protected const SLUG = 'x_initialize_media_upload';

    protected const DESCRIPTION = 'Initialize media upload';

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
    ];

    protected const OPERATION = [
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
    ];
}
