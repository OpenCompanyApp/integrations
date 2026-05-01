<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Send Chat Message
 */
class XSendChatMessage extends XGeneratedTool
{
    protected const SLUG = 'x_send_chat_message';

    protected const DESCRIPTION = 'Send Chat Message';

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
                'conversation_token' => [
                    'type' => 'string',
                    'description' => 'Optional conversation token.',
                    'required' => false,
                ],
                'encoded_message_create_event' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded Thrift MessageCreateEvent containing encrypted message contents.',
                    'required' => true,
                ],
                'encoded_message_event_signature' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded Thrift MessageEventSignature for message verification.',
                    'required' => false,
                ],
                'message_id' => [
                    'type' => 'string',
                    'description' => 'Unique identifier for this message.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'sendChatMessage',
        'method' => 'POST',
        'path' => '/2/chat/conversations/{id}/messages',
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
