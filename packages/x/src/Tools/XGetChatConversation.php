<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Chat Conversation
 */
class XGetChatConversation extends XGeneratedTool
{
    protected const SLUG = 'x_get_chat_conversation';

    protected const DESCRIPTION = 'Get Chat Conversation';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Maximum number of message events to return.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Token for pagination to retrieve the next page of results.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getChatConversation',
        'method' => 'GET',
        'path' => '/2/chat/conversations/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
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
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
