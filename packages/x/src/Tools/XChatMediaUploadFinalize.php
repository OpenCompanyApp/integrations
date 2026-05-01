<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Finalize Chat Media Upload
 */
class XChatMediaUploadFinalize extends XGeneratedTool
{
    protected const SLUG = 'x_chat_media_upload_finalize';

    protected const DESCRIPTION = 'Finalize Chat Media Upload';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The session/resume id from initialize.',
        ],
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
                'media_hash_key' => [
                    'type' => 'string',
                    'description' => 'Media hash key returned from initialize.',
                    'required' => false,
                ],
                'message_id' => [
                    'type' => 'string',
                    'description' => 'Optional message identifier associated with the upload.',
                    'required' => false,
                ],
                'num_parts' => [
                    'type' => 'string',
                    'description' => 'Total number of uploaded parts as a numeric string.',
                    'required' => false,
                ],
                'ttl_msec' => [
                    'type' => 'string',
                    'description' => 'Optional TTL for the media in milliseconds.',
                    'required' => false,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'chatMediaUploadFinalize',
        'method' => 'POST',
        'path' => '/2/chat/media/upload/{id}/finalize',
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
            'Chat',
        ],
    ];
}
