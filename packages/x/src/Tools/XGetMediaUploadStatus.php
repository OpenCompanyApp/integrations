<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Media upload status
 */
class XGetMediaUploadStatus extends XGeneratedTool
{
    protected const SLUG = 'x_get_media_upload_status';

    protected const DESCRIPTION = 'Get Media upload status';

    protected const PARAMETERS = [
        'media_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Media id for the requested media upload status.',
        ],
        'command' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The command for the media upload request.',
            'enum' => [
                'STATUS',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getMediaUploadStatus',
        'method' => 'GET',
        'path' => '/2/media/upload',
        'parameters' => [
            [
                'name' => 'media_id',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'command',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
        ],
        'has_body' => false,
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
