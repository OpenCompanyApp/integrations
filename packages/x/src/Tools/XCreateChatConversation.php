<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create Chat Group Conversation
 */
class XCreateChatConversation extends XGeneratedTool
{
    protected const SLUG = 'x_create_chat_conversation';

    protected const DESCRIPTION = 'Create Chat Group Conversation';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createChatConversation',
        'method' => 'POST',
        'path' => '/2/chat/conversations/group',
        'parameters' => [
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
