<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Add members to a Chat group conversation
 */
class XAddChatGroupMembers extends XGeneratedTool
{
    protected const SLUG = 'x_add_chat_group_members';

    protected const DESCRIPTION = 'Add members to a Chat group conversation';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Chat group conversation ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'addChatGroupMembers',
        'method' => 'POST',
        'path' => '/2/chat/conversations/{id}/members',
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
