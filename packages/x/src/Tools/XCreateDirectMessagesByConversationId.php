<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create DM message by conversation ID
 */
class XCreateDirectMessagesByConversationId extends XGeneratedTool
{
    protected const SLUG = 'x_create_direct_messages_by_conversation_id';

    protected const DESCRIPTION = 'Create DM message by conversation ID';

    protected const PARAMETERS = [
        'dm_conversation_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The DM Conversation ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createDirectMessagesByConversationId',
        'method' => 'POST',
        'path' => '/2/dm_conversations/{dm_conversation_id}/messages',
        'parameters' => [
            [
                'name' => 'dm_conversation_id',
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
            'Direct Messages',
        ],
    ];
}
