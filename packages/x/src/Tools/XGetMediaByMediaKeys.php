<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Media by media keys
 */
class XGetMediaByMediaKeys extends XGeneratedTool
{
    protected const SLUG = 'x_get_media_by_media_keys';

    protected const DESCRIPTION = 'Get Media by media keys';

    protected const PARAMETERS = [
        'media_keys' => [
            'type' => 'array',
            'required' => true,
            'description' => 'A comma separated list of Media Keys. Up to 100 are allowed in a single request.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
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
