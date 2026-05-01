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
        ],
    ];

    protected const OPERATION = [
        'id' => 'mediaUpload',
        'method' => 'POST',
        'path' => '/2/media/upload',
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
