<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Initialize Conversation Keys
 */
class XInitializeChatConversationKeys extends XGeneratedTool
{
    protected const SLUG = 'x_initialize_chat_conversation_keys';

    protected const DESCRIPTION = 'Initialize Conversation Keys';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'action_signatures' => [
                    'type' => 'array',
                    'description' => 'Cryptographic signatures for the key initialization action.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => false,
                ],
                'base64_encoded_key_rotation' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded key rotation payload for ratchet tree key management.',
                    'required' => false,
                ],
                'conversation_key_version' => [
                    'type' => 'string',
                    'description' => 'Version of the conversation encryption key (typically a timestamp in milliseconds).',
                    'required' => true,
                ],
                'conversation_participant_keys' => [
                    'type' => 'array',
                    'description' => 'The conversation key encrypted for each participant using their public key.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'initializeChatConversationKeys',
        'method' => 'POST',
        'path' => '/2/chat/conversations/{id}/keys',
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
            'dm.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
