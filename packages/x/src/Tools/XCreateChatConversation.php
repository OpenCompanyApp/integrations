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
            'properties' => [
                'action_signatures' => [
                    'type' => 'array',
                    'description' => 'Cryptographic signatures for the create action.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => false,
                ],
                'base64_encoded_key_rotation' => [
                    'type' => 'string',
                    'description' => 'Base64-encoded key rotation payload.',
                    'required' => false,
                ],
                'conversation_id' => [
                    'type' => 'string',
                    'description' => 'Client-generated conversation ID.',
                    'required' => true,
                ],
                'conversation_key_version' => [
                    'type' => 'string',
                    'description' => 'Version of the conversation encryption key.',
                    'required' => true,
                ],
                'conversation_participant_keys' => [
                    'type' => 'array',
                    'description' => 'Encrypted conversation keys for each participant.',
                    'items' => [
                        'type' => 'object',
                    ],
                    'required' => true,
                ],
                'group_admins' => [
                    'type' => 'array',
                    'description' => 'User IDs of group admins. Defaults to the creator if omitted.',
                    'items' => [
                        'type' => 'string',
                    ],
                    'required' => false,
                ],
                'group_avatar_url' => [
                    'type' => 'string',
                    'description' => 'URL of the avatar image for the group conversation.',
                    'required' => false,
                ],
                'group_description' => [
                    'type' => 'string',
                    'description' => 'Description for the group conversation.',
                    'required' => false,
                ],
                'group_members' => [
                    'type' => 'array',
                    'description' => 'User IDs of group members to include in the conversation.',
                    'items' => [
                        'type' => 'string',
                    ],
                    'required' => true,
                ],
                'group_name' => [
                    'type' => 'string',
                    'description' => 'Display name for the group conversation.',
                    'required' => false,
                ],
                'ttl_msec' => [
                    'type' => 'string',
                    'description' => 'Message time-to-live in milliseconds. Messages expire after this duration.',
                    'required' => false,
                ],
            ],
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
