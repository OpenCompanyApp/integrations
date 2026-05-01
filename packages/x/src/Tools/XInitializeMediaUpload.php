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
