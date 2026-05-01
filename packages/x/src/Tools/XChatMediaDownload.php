<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Download Chat Media
 */
class XChatMediaDownload extends XGeneratedTool
{
    protected const SLUG = 'x_chat_media_download';

    protected const DESCRIPTION = 'Download Chat Media';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
        ],
        'media_hash_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media hash key returned from the upload initialize step.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'chatMediaDownload',
        'method' => 'GET',
        'path' => '/2/chat/media/{id}/{media_hash_key}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'media_hash_key',
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
            'Chat',
        ],
    ];
}
