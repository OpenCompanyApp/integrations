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
