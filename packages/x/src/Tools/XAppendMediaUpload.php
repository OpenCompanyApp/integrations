<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Append Media upload
 */
class XAppendMediaUpload extends XGeneratedTool
{
    protected const SLUG = 'x_append_media_upload';

    protected const DESCRIPTION = 'Append Media upload';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media identifier for the media to perform the append operation.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
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
