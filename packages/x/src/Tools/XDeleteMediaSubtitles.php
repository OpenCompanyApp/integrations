<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete Media subtitles
 */
class XDeleteMediaSubtitles extends XGeneratedTool
{
    protected const SLUG = 'x_delete_media_subtitles';

    protected const DESCRIPTION = 'Delete Media subtitles';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteMediaSubtitles',
        'method' => 'DELETE',
        'path' => '/2/media/subtitles',
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
