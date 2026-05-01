<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Finalize Media upload
 */
class XFinalizeMediaUpload extends XGeneratedTool
{
    protected const SLUG = 'x_finalize_media_upload';

    protected const DESCRIPTION = 'Finalize Media upload';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media id of the targeted media to finalize.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'finalizeMediaUpload',
        'method' => 'POST',
        'path' => '/2/media/upload/{id}/finalize',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
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
