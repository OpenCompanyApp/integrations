<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create DM conversation
 */
class XCreateDirectMessagesConversation extends XGeneratedTool
{
    protected const SLUG = 'x_create_direct_messages_conversation';

    protected const DESCRIPTION = 'Create DM conversation';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'conversation_type' => [
                    'type' => 'string',
                    'description' => 'The conversation type that is being created.',
                    'enum' => [
                        'Group',
                    ],
                    'required' => true,
                ],
                'message' => [
                    'type' => 'string',
                    'description' => '',
                    'required' => true,
                ],
                'participant_ids' => [
                    'type' => 'array',
                    'description' => 'Participants for the DM Conversation.',
                    'items' => [
                        'type' => 'string',
                    ],
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'createDirectMessagesConversation',
        'method' => 'POST',
        'path' => '/2/dm_conversations',
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
            'Direct Messages',
        ],
    ];
}
