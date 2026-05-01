<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Media by media key
 */
class XGetMediaByMediaKey extends XGeneratedTool
{
    protected const SLUG = 'x_get_media_by_media_key';

    protected const DESCRIPTION = 'Get Media by media key';

    protected const PARAMETERS = [
        'media_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A single Media Key.',
        ],
    ];

    protected const OPERATION = [
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
    ];
}
