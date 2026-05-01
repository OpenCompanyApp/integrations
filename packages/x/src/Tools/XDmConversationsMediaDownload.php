<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Download DM Media
 */
class XDmConversationsMediaDownload extends XGeneratedTool
{
    protected const SLUG = 'x_dm_conversations_media_download';

    protected const DESCRIPTION = 'Download DM Media';

    protected const PARAMETERS = [
        'dm_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the Direct Message event containing the media.',
        ],
        'media_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the media attached to the Direct Message.',
        ],
        'resource_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The resource identifier of the media file, including file extension (e.g. \'hVJQTwig.jpg\').',
        ],
    ];

    protected const OPERATION = [
        'id' => 'dmConversationsMediaDownload',
        'method' => 'GET',
        'path' => '/2/dm_conversations/media/{dm_id}/{media_id}/{resource_id}',
        'parameters' => [
            [
                'name' => 'dm_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'media_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'resource_id',
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
        ],
        'required_scopes' => [
            'dm.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Direct Messages',
        ],
    ];
}
