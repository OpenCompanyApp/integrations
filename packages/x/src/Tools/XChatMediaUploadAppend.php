<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Append Chat Media Upload
 */
class XChatMediaUploadAppend extends XGeneratedTool
{
    protected const SLUG = 'x_chat_media_upload_append';

    protected const DESCRIPTION = 'Append Chat Media Upload';

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
                    'required' => true,
                ],
                'media' => [
                    'type' => 'string',
                    'description' => 'The file to upload.',
                    'required' => true,
                ],
                'media_hash_key' => [
                    'type' => 'string',
                    'description' => 'Media hash key returned from initialize.',
                    'required' => true,
                ],
                'segment_index' => [
                    'type' => 'string',
                    'description' => 'An integer value representing the media upload segment.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'chatMediaUploadAppend',
        'method' => 'POST',
        'path' => '/2/chat/media/upload/{id}/append',
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
        'body_mode' => 'multipart',
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
