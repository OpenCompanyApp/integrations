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
            'properties' => [
                'action_signatures' => [
                    'type' => 'array',
                    'description' => 'Cryptographic signatures for the add-members action.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => false,
                ],
                'conversation_key_version' => [
                    'type' => 'string',
                    'description' => 'Version of the new rotated conversation key.',
                    'required' => false,
                ],
                'conversation_participant_keys' => [
                    'type' => 'array',
                    'description' => 'Encrypted conversation keys for each new participant after key rotation.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => false,
                ],
                'encrypted_avatar_url' => [
                    'type' => 'string',
                    'description' => 'Re-encrypted group avatar URL with new conversation key.',
                    'required' => false,
                ],
                'encrypted_title' => [
                    'type' => 'string',
                    'description' => 'Re-encrypted group title with new conversation key.',
                    'required' => false,
                ],
                'user_ids' => [
                    'type' => 'array',
                    'description' => 'List of user IDs to add to the group conversation.',
                    'items' => [
                        'type' => 'string',
                    ],
                    'required' => true,
                ],
            ],
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
