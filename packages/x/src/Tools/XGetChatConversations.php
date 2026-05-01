<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Chat Conversations
 */
class XGetChatConversations extends XGeneratedTool
{
    protected const SLUG = 'x_get_chat_conversations';

    protected const DESCRIPTION = 'Get Chat Conversations';

    protected const PARAMETERS = [
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Maximum number of conversations to return.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token for pagination to retrieve the next page of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getChatConversations',
        'method' => 'GET',
        'path' => '/2/chat/conversations',
        'parameters' => [
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
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
            'dm.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
