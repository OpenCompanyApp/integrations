<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Initialize Chat Media Upload
 */
class XChatMediaUploadInitialize extends XGeneratedTool
{
    protected const SLUG = 'x_chat_media_upload_initialize';

    protected const DESCRIPTION = 'Initialize Chat Media Upload';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'conversation_id' => [
                    'type' => 'string',
                    'description' => 'XChat conversation identifier for the upload.',
                    'required' => false,
                ],
                'total_bytes' => [
                    'type' => 'integer',
                    'description' => 'Total size of the media upload in bytes.',
                    'required' => false,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'chatMediaUploadInitialize',
        'method' => 'POST',
        'path' => '/2/chat/media/upload/initialize',
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
            'Chat',
        ],
    ];
}
